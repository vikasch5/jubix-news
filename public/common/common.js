function notify_it(status, message, redirectUrl = null, type = 'alert', options = {}) {
    const defaultTitle = status.charAt(0).toUpperCase() + status.slice(1);
    if (type === 'alert') {
        return Swal.fire({
            icon: status,
            title: options.title || defaultTitle,
            html: message,
            // timer: options.timer || 2000,
            showConfirmButton: true, // Show button
            confirmButtonText: options.confirmButtonText || "Okay", // Button label
            showCloseButton: options.showCloseButton ?? false, // Optional X button
            allowOutsideClick: false, // Prevent closing by clicking outside
            allowEscapeKey: false // Prevent closing with Esc key
        }).then((result) => {
            if (redirectUrl && result.isConfirmed) {
                window.location.href = redirectUrl;
            }
        });
    }

    // Toast notification
    if (type === 'toast') {
        if (typeof flasher[status] === 'function') {
            flasher[status](message);
            if (redirectUrl) {
                setTimeout(() => {
                    window.location.href = redirectUrl;
                }, options.redirectDelay || 2000);
            }
        } else {
            console.error(`Invalid toast status: ${status}`);
        }
        return;
    }
}