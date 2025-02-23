jQuery(document).ready(function ($) {
    $(document).on("click", ".copy-download-link", function (e) {
        e.preventDefault(); // 🔹 Prevent default button behavior (avoid page refresh)

        var linkField = $(this).siblings(".download-link");
        linkField.select();
        
        navigator.clipboard.writeText(linkField.val()).then(() => {
            $(this).after("<span class='copy-success'>Copied!</span>");
            setTimeout(() => {
                $(".copy-success").fadeOut(500, function () {
                    $(this).remove();
                });
            }, 1500);
        }).catch(err => console.error("Copy failed: ", err));
    });
});
