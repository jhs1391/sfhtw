(function (blocks, element) {
    var el = element.createElement;

    blocks.registerBlockType('digits/login', {
        edit: function () {
            return el('div', {class: 'digits_sc_block_wrap_editor components-placeholder'}, 'Digits Login Form');
        },
    });
})(window.wp.blocks, window.wp.element);
