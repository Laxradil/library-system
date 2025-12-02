@once
    @push('scripts')
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                window.dispatchEvent(new CustomEvent('book-portal-ready'));
            });
        </script>
    @endpush
@endonce

<div x-data="bookPortal()" x-init="init()" class="">
    <template x-teleport="body">
        <div x-show="open" x-cloak class="fixed inset-0 z-[9999] flex items-center justify-center">
            <div class="absolute inset-0 bg-black/70 dark:bg-black/80 backdrop-blur-sm transition-opacity duration-300" @click="close()"></div>

            <div x-show="open" x-transition class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-6xl max-h-[88vh] overflow-hidden mx-4">
                <button @click="close()" class="absolute right-6 top-6 z-50 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 bg-white dark:bg-gray-800 ring-1 ring-black/5 dark:ring-white/5 p-2 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6 max-h-[78vh] overflow-y-auto">
                    <div class="col-span-1 flex items-start md:items-stretch justify-center md:justify-start">
                        <div class="w-56 h-80 rounded-lg shadow-xl overflow-hidden ring-1 ring-black/5 dark:ring-white/5">
                            <template x-if="book && book.cover">
                                <img :src="book.cover_url" :alt="book.title" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!book || !book.cover">
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-800 text-gray-500 text-sm text-center">No cover</div>
                            </template>
                        </div>
                    </div>

                    <div class="col-span-2 space-y-4 pr-2">
                        <div class="flex items-start justify-between">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100" x-text="book?.title"></h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span class="font-medium text-gray-700 dark:text-gray-300" x-text="book?.author || 'Unknown Author'"></span>
                                </p>
                            </div>
                        </div>

                        <!-- Rating Stars -->
                        <div class="flex items-center gap-3 py-2">
                            <div class="flex items-center gap-1">
                                <template x-for="i in 5" :key="i">
                                    <svg class="w-5 h-5" :class="i <= (book?.rating || 0) ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600'" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </template>
                            </div>
                            <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                <span x-text="book?.rating || 0"></span>/5
                            </span>
                        </div>

                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 dark:text-gray-300 py-2 border-t border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center gap-2" x-show="book?.published_at">
                                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span>Published: <strong class="font-medium text-gray-800 dark:text-gray-200" x-text="book?.published_at_formatted"></strong></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Added: <strong class="font-medium text-gray-800 dark:text-gray-200" x-text="book?.created_at_formatted"></strong></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>By: <strong class="font-medium text-gray-800 dark:text-gray-200" x-text="book?.user?.name"></strong></span>
                            </div>
                        </div>

                        <div class="pt-3">
                            <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap" x-text="book?.description"></p>
                        </div>

                        <div class="mt-4">
                            <template x-if="book?.genre">
                                <div class="flex flex-wrap gap-2">
                                    <template x-for="tag in (book.genre || '').split(',')" :key="tag">
                                        <span class="inline-block px-3 py-1 bg-gradient-to-r from-blue-100 to-blue-50 dark:from-blue-900/50 dark:to-blue-800/50 text-blue-700 dark:text-blue-300 text-xs font-medium rounded-full border border-blue-200 dark:border-blue-700/50" x-text="tag.trim()"></span>
                                    </template>
                                </div>
                            </template>
                        </div>

                        <div class="mt-6 flex items-center gap-3 justify-end">
                            <template x-if="loggedIn">
                                <form :action="'/wishlist'" method="POST" class="inline">
                                    <input type="hidden" name="_token" :value="csrf">
                                    <input type="hidden" name="book_id" :value="book?.id">
                                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200 active:scale-95">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"></path></svg>
                                        Add to Wishlist
                                    </button>
                                </form>
                            </template>
                            <button @click="close()" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 text-sm font-semibold rounded-lg transition-all duration-200">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>

<script>
    function bookPortal(){
        return {
            open: false,
            book: null,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            loggedIn: !!document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            // track which card view element we hid so we can restore it on close
            lastHiddenId: null,
            loading: false,
            init(){
                window.addEventListener('open-book-modal', e => {
                    const id = e.detail?.id;
                    if (!id) return;
                    this.load(id);
                });
                // optional ready event
                window.dispatchEvent(new CustomEvent('book-portal-initialized'));
            },
            close(){
                this.open = false;
                document.documentElement.classList.remove('overflow-hidden');
                // restore visibility of the underlying card's views indicator
                if (this.lastHiddenId) {
                    const els = document.querySelectorAll('[data-book-views="' + this.lastHiddenId + '"]');
                    els.forEach(el => el.classList.remove('invisible'));
                    this.lastHiddenId = null;
                }
            },
            load(id){
                // guard against concurrent loads
                if (this.loading) return;
                this.loading = true;

                // Use the dedicated increment endpoint to ensure a single increment
                // per modal open. Send CSRF token for the POST.
                const token = this.csrf;
                fetch('/books/' + id + '/increment', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                    body: JSON.stringify({})
                })
                .then(r => r.ok ? r.json() : null)
                .then(data => {
                    if (!data) return;
                    // normalize some fields
                    data.cover_url = data.cover ? '/storage/' + data.cover : null;
                    data.published_at_formatted = data.published_at ? new Date(data.published_at).toLocaleDateString() : '';
                    data.created_at_formatted = data.created_at ? new Date(data.created_at).toLocaleDateString() : '';
                    this.book = data;
                    this.open = true;
                    document.documentElement.classList.add('overflow-hidden');

                    // Hide all underlying card view elements to avoid visual duplication
                    const viewEls = document.querySelectorAll('[data-book-views="' + id + '"]');
                    if (viewEls && viewEls.length) {
                        try {
                            const formatted = new Intl.NumberFormat().format(data.views || 0);
                            viewEls.forEach(el => el.textContent = formatted);
                        } catch (err) {}
                        viewEls.forEach(el => el.classList.add('invisible'));
                        this.lastHiddenId = id;
                    }
                })
                .catch((err) => {
                    console.error('bookPortal: increment request failed', err);
                })
                .finally(() => {
                    this.loading = false;
                });
            }
        };
    }
</script>