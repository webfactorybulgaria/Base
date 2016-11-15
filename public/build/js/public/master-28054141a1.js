/**
 * Fancyboxes
 */
$('.fancybox').fancybox({
    prevEffect: 'none',
    nextEffect: 'none',
    openEffect: 'elastic',
    closeEffect: 'none',
    padding: 0,
    margin: [60, 60, 20, 60],
    helpers : {
        title : {
            type: 'outside'
        },
        overlay : {
            css : {
                'background' : 'rgba(0,0,0,0.8)'
            }
        }
    },
    afterLoad: function() {
        this.title = this.title + ' | ' + this.element[0].getAttribute('data-descr');
    }
});
