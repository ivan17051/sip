(function( $ ) {
 
    $.fn.myFormAndToggle = function(options) {

        if(this['0'] instanceof HTMLElement && this['0'].dataset.myformindex){
            let _mft =  window.mft[this['0'].dataset.myformindex]
            return _mft
        }

        if(!window.mft){
            window.mft = []
        }

        let index = window.mft.length
 
        var settings = $.extend({
            // These are the defaults.
            actionSection: this.find(".myform-actions")
        }, options );

        this.mft = {
            state: 0,
            toggle: function(state){
                state = (state==null) ? this.state : !state
                if(state==0)
                {
                    settings.actionSection.find('[data-state=0]').hide()
                    settings.actionSection.find('[data-state=1]').show()
                    this.state=1
                }
                else{
                    settings.actionSection.find('[data-state=0]').show()
                    settings.actionSection.find('[data-state=1]').hide()
                    this.state=0
                }
            }
        }

        settings.actionSection.find('button').each(function(){
            $(this).attr('data-myformindex', index);
        })

        this.mft.toggle(0)

        window.mft.push(this.mft)
 
        return this;
 
    };
 
}( jQuery ));