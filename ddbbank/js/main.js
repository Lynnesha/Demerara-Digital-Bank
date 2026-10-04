(() => {
  // Keep the compact navigation usable on small screens while exposing its state to assistive technology.
  const menuButton = document.querySelector('.menu-toggle');
  const menu = document.querySelector('.primary-nav');
  if (menuButton && menu) {
    menuButton.addEventListener('click', () => {
      const opened = menu.classList.toggle('is-open');
      menuButton.setAttribute('aria-expanded', String(opened));
    });
  }

  const registerForm = document.querySelector('[data-register-form]');
  if (registerForm) {
    const clientError = document.querySelector('#register-client-error');
    // Ignore the hidden CSRF token: it is validated by PHP rather than by browser-side field rules.
    const fields = Array.from(registerForm.querySelectorAll('input[name], select[name]'))
      .filter((field) => field.name !== 'csrf_token');
    const eighteenYearsAgo = new Date();
    eighteenYearsAgo.setFullYear(eighteenYearsAgo.getFullYear() - 18);

    // Mirror the server-side registration rules so visitors receive useful feedback before submission.
    const registrationMessage = (field) => {
      const value = field.value.trim();
      if (field.name === 'first_name' || field.name === 'last_name') {
        return /^[a-zA-ZÀ-ÿ' -]{2,60}$/.test(value) ? '' : 'Enter at least two letters for this name.';
      }
      if (field.name === 'email') {
        return field.validity.valid ? '' : 'Enter a valid email address.';
      }
      if (field.name === 'phone') {
        return value.replace(/[^0-9+]/g, '').length >= 7 ? '' : 'Enter a valid telephone number.';
      }
      if (field.name === 'date_of_birth') {
        const dateOfBirth = value ? new Date(`${value}T00:00:00`) : null;
        return dateOfBirth && dateOfBirth <= eighteenYearsAgo ? '' : 'You must be at least 18 years old for this demonstration account.';
      }
      if (field.name === 'username') {
        return /^[a-zA-Z0-9_.-]{4,40}$/.test(value) ? '' : 'Use 4–40 letters, numbers, dots, dashes or underscores.';
      }
      if (field.name === 'password') {
        return value.length >= 8 ? '' : 'Password must be at least 8 characters.';
      }
      if (field.name === 'confirm_password') {
        const password = registerForm.querySelector('[name="password"]');
        return value !== '' && value === password.value ? '' : 'Passwords must match.';
      }
      if (field.name === 'account_type') {
        return ['Savings', 'Chequing', 'Investment'].includes(value) ? '' : 'Choose a valid account type.';
      }
      return '';
    };

    // Use the browser validity API so the visual message and accessibility state stay in sync.
    const validateRegistrationField = (field) => {
      const message = registrationMessage(field);
      field.setCustomValidity(message);
      field.setAttribute('aria-invalid', message ? 'true' : 'false');
      return message;
    };

    const showRegistrationMessage = (message) => {
      if (clientError) clientError.textContent = message;
    };

    fields.forEach((field) => {
      const validateLive = () => {
        const message = validateRegistrationField(field);
        // Recheck confirmation when the primary password changes after it has been entered.
        if (field.name === 'password') {
          const confirmation = registerForm.querySelector('[name="confirm_password"]');
          if (confirmation.value) validateRegistrationField(confirmation);
        }
        showRegistrationMessage(message);
      };
      field.addEventListener('input', validateLive);
      field.addEventListener('change', validateLive);
      field.addEventListener('blur', validateLive);
    });

    registerForm.addEventListener('submit', (event) => {
      const invalidField = fields.find((field) => validateRegistrationField(field));
      if (invalidField) {
        event.preventDefault();
        showRegistrationMessage(registrationMessage(invalidField));
        invalidField.focus();
      }
    });
  }

  const calculator = document.querySelector('#investment-calculator');
  if (calculator) {
    const format = (number) => new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(number);
    const calculate = () => {
      const initial = Number(calculator.elements.initial.value);
      const monthly = Number(calculator.elements.monthly.value);
      const annual = Number(calculator.elements.return.value);
      const years = Number(calculator.elements.years.value);
      const error = document.querySelector('#calculator-error');
      if ([initial, monthly, annual, years].some((value) => Number.isNaN(value) || value < 0) || years < 1) {
        error.textContent = 'Enter valid non-negative amounts and a period of at least one year.';
        return;
      }
      error.textContent = '';
      // Calculate the future value of the opening balance and monthly contributions using monthly compounding.
      const months = years * 12;
      const rate = annual / 100 / 12;
      const initialGrowth = initial * Math.pow(1 + rate, months);
      const contributionGrowth = rate === 0 ? monthly * months : monthly * ((Math.pow(1 + rate, months) - 1) / rate);
      const finalBalance = initialGrowth + contributionGrowth;
      const contributed = initial + monthly * months;
      document.querySelector('#contributed-result').textContent = format(contributed);
      document.querySelector('#growth-result').textContent = format(Math.max(0, finalBalance - contributed));
      document.querySelector('#final-result').textContent = format(finalBalance);
    };
    calculator.addEventListener('submit', (event) => { event.preventDefault(); calculate(); });
    calculate();
  }

  // Filter locally rendered fictional transactions without making a new request for each search.
  const filters = document.querySelectorAll('.filter-button');
  const rows = document.querySelectorAll('[data-transaction-row]');
  const search = document.querySelector('#transaction-search');
  const noResults = document.querySelector('#no-transactions');
  let currentFilter = 'all';
  const refreshTransactions = () => {
    const searchTerm = (search?.value || '').trim().toLowerCase();
    let visible = 0;
    rows.forEach((row) => {
      const fitsFilter = currentFilter === 'all' || row.dataset.type === currentFilter;
      const fitsSearch = !searchTerm || row.dataset.search.includes(searchTerm);
      const show = fitsFilter && fitsSearch;
      row.hidden = !show;
      if (show) visible += 1;
    });
    if (noResults) noResults.hidden = visible !== 0;
  };
  filters.forEach((button) => button.addEventListener('click', () => {
    currentFilter = button.dataset.filter;
    filters.forEach((item) => item.classList.toggle('active', item === button));
    refreshTransactions();
  }));
  search?.addEventListener('input', refreshTransactions);

  // Show only the recipient field that matches the chosen simulated transfer type.
  const transferType = document.querySelector('#transfer_type');
  const ownRecipient = document.querySelector('#own-recipient');
  const ddbRecipient = document.querySelector('#ddb-recipient');
  const toggleRecipient = () => {
    if (!transferType) return;
    const own = transferType.value === 'own';
    ownRecipient.hidden = !own;
    ddbRecipient.hidden = own;
  };
  transferType?.addEventListener('change', toggleRecipient);
  toggleRecipient();
})();
