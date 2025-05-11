jQuery(document).ready(function($) {
    // Copy link functionality
    $('.copy-download-link').on('click', function(e) {
        e.preventDefault();
        const $button = $(this);
        const $input = $button.siblings('.download-link');
        
        // Select the text
        $input.select();
        
        try {
            // Copy the text
            document.execCommand('copy');
            
            // Show success message
            const originalText = $button.text();
            $button.text(wdmData.copySuccess);
            
            // Reset button text after 2 seconds
            setTimeout(function() {
                $button.text(originalText);
            }, 2000);
        } catch (err) {
            // Show error message
            $button.text(wdmData.copyError);
            
            // Reset button text after 2 seconds
            setTimeout(function() {
                $button.text('Copy');
            }, 2000);
        }
        
        // Deselect the text
        $input.blur();
    });
    
    // Add loading state to view button
    $('.view-link').on('click', function() {
        const $button = $(this);
        $button.addClass('loading');
        
        // Remove loading state after 1 second
        setTimeout(function() {
            $button.removeClass('loading');
        }, 1000);
    });
}); 