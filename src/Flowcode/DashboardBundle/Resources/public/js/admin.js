
function sayToUser(level, message) {
    switch (level) {
        case 'success':
            $().toastmessage('showSuccessToast', message);
            break;
        case 'warning':
            $().toastmessage('showWarningToast', message);
            break;
        case 'error':
            $().toastmessage('showErrorToast', message);
            break;
        case 'notice':
            $().toastmessage('showNoticeToast', message);
            break;

        default:
            $().toastmessage('showNoticeToast', message);
            break;
    }
}
