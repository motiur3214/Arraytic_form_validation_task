$(document).ready(function () {
    $('#submissionForm').on('submit', function (e) {
        // Amount validation: only numbers
        let amount = $('#amount').val();
        if (!/^\d+$/.test(amount)) {
            alert('Amount must be a number.');
            e.preventDefault();
            return;
        }

        // Buyer validation: only text, spaces, and numbers, not more than 20 characters
        let buyer = $('#buyer').val();
        if (!/^[\w\s]{1,20}$/.test(buyer)) {
            alert('Buyer name must be alphanumeric and less than 20 characters.');
            e.preventDefault();
            return;
        }

        // Note validation: not more than 30 words
        let note = $('#note').val();
        if (note.split(' ').length > 30) {
            alert('Note must not exceed 30 words.');
            e.preventDefault();
            return;
        }

        // City validation: only text and spaces
        let city = $('#city').val();
        if (!/^[a-zA-Z\s]+$/.test(city)) {
            alert('City must only contain letters and spaces.');
            e.preventDefault();
            return;
        }

        // Phone validation: only numbers (with "880" already prepended)
        let phone = $('#phone').val();
        if (!/^880\d+$/.test(phone)) {
            alert('Phone number must start with "880" and be numeric.');
            e.preventDefault();
            return;
        }

        // Entry By validation: only numbers
        let entryBy = $('#entry_by').val();
        if (!/^\d+$/.test(entryBy)) {
            alert('Entry By must be a number.');
            e.preventDefault();
            return;
        }

        // Prevent multiple submissions within 24 hours
        if (document.cookie.indexOf('submitted=true') !== -1) {
            alert('You have already submitted the form. Please try again after 24 hours.');
            e.preventDefault();
        } else {
            document.cookie = "submitted=true; max-age=86400"; // 24 hours in seconds
        }
    });
});