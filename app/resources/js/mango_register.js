$("#nickname").on("input", function() {
    var regexp = /[^a-z]/g;
    if (this.value.match(regexp)) {
        $(this).val(this.value.replace(regexp, ''));
    }
});