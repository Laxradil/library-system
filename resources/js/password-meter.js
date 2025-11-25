// password-meter.js
// Live password strength meter for register form
document.addEventListener('DOMContentLoaded', () => {
  const password = document.getElementById('password');
  const passwordConfirmation = document.getElementById('password_confirmation');
  const form = password ? password.closest('form') : null;
  if (!password || !form) return;

  const meterBar = document.getElementById('password-meter-bar');
  const msg = document.getElementById('password-meter-msg');
  const lengthCheck = document.getElementById('pw-check-length');
  const numberCheck = document.getElementById('pw-check-number');
  const symbolCheck = document.getElementById('pw-check-symbol');
  const submitButtons = Array.from(form.querySelectorAll('button[type="submit"], input[type="submit"]'));
  const reasonEl = document.getElementById('password-submit-reason');

  const minLen = 8;
  const maxLen = 64;

  function hasNumber(s) { return /\d/.test(s); }
  function hasSymbol(s) { return /[^A-Za-z0-9]/.test(s); }
  function hasUpper(s) { return /[A-Z]/.test(s); }
  function hasLower(s) { return /[a-z]/.test(s); }
  function validLength(s) { return s.length >= minLen && s.length <= maxLen; }

  function scorePassword(s) {
    // scoring components
    let score = 0;
    // length score: 0..2
    if (s.length >= 12) score += 2;
    else if (s.length >= 8) score += 1;

    // number
    if (hasNumber(s)) score += 1;
    // symbol
    if (hasSymbol(s)) score += 1;
    // mixed case
    if (hasUpper(s) && hasLower(s)) score += 1;
    // unique chars
    const uniq = new Set(s.split('')).size;
    if (uniq >= 5) score += 1;

    return score; // max 6
  }

  function evaluationLabel(score) {
    const pct = Math.round((score / 6) * 100);
    if (pct <= 33) return { label: 'Weak', color: '#ef4444' }; // red
    if (pct <= 66) return { label: 'Good', color: '#f59e0b' }; // yellow
    return { label: 'Strong', color: '#16a34a' }; // green
  }

  function update() {
    const val = password.value || '';

    // primary checks that gate submission
    const checks = {
      length: validLength(val),
      number: hasNumber(val),
      symbol: hasSymbol(val),
    };

    // update checklist UI (toggle green text when satisfied)
    if (lengthCheck) lengthCheck.classList.toggle('text-green-600', checks.length);
    if (numberCheck) numberCheck.classList.toggle('text-green-600', checks.number);
    if (symbolCheck) symbolCheck.classList.toggle('text-green-600', checks.symbol);

    // compute score and evaluation
    const score = scorePassword(val);
    const evalObj = evaluationLabel(score);
    const pct = Math.round((score / 6) * 100);

    // update meter bar width and color via inline style to avoid Tailwind purge issues
    if (meterBar) {
      meterBar.style.width = pct + '%';
      meterBar.style.transition = 'width 200ms ease';
      meterBar.style.backgroundColor = evalObj.color;
    }

    // message logic: if primary checks not satisfied, show requirements; otherwise show evaluation
    if (msg) {
      if (!checks.length || !checks.number || !checks.symbol) {
        msg.textContent = 'Password must be 8–64 characters and include at least one number and one symbol.';
        msg.style.color = '#374151'; // gray-700
      } else {
        msg.textContent = evalObj.label + ' password';
        msg.style.color = evalObj.color;
      }
    }

    // disable submit if primary checks fail or confirmation mismatch
    const confirmationOk = !passwordConfirmation || passwordConfirmation.value === '' || (passwordConfirmation.value === password.value);
    const enable = checks.length && checks.number && checks.symbol && confirmationOk;

    // update submit buttons: disabled state and visual disabled classes
    submitButtons.forEach(btn => {
      btn.disabled = !enable;
      if (!enable) {
        btn.classList.add('opacity-50', 'cursor-not-allowed');
        btn.setAttribute('aria-disabled', 'true');
      } else {
        btn.classList.remove('opacity-50', 'cursor-not-allowed');
        btn.removeAttribute('aria-disabled');
      }
    });

    // show a reason why submission is blocked
    if (reasonEl) {
      if (!checks.length || !checks.number || !checks.symbol) {
        reasonEl.textContent = 'Password must be 8–64 characters and include at least one number and one symbol.';
      } else if (!confirmationOk) {
        reasonEl.textContent = 'Password confirmation does not match.';
      } else {
        reasonEl.textContent = '';
      }
    }
  }

  password.addEventListener('input', update);
  if (passwordConfirmation) passwordConfirmation.addEventListener('input', update);

  // initialize
  update();
});
