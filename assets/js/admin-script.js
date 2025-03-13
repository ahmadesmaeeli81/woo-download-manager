jQuery(document).ready(function($) {
    // Copy download link functionality
    $('.copy-download-link').on('click', function() {
        var $button = $(this);
        var $input = $button.prev('.download-link');
        
        // Select the text
        $input.select();
        
        try {
            // Copy the text
            document.execCommand('copy');
            
            // Show success message
            var $success = $('<span class="copy-success">Copied!</span>');
            $button.after($success);
            
            // Remove success message after animation completes
            setTimeout(function() {
                $success.remove();
            }, 3000);
        } catch (err) {
            console.error('Unable to copy: ', err);
        }
        
        // Deselect the text
        $input.blur();
        
        return false;
    });
    
    // Make the entire input field selectable with one click
    $('.download-link').on('click', function() {
        $(this).select();
    });
});
