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
            actionSection: this.find(".myform-actions"),
            inputs: this.find('input[data-editable=true], select[data-editable=true]'),
            texts: this.find('[data-text=true]'),
        }, options );

        this.mft = {
            state: 0,
            toggle: function(state){
                state = (state==null) ? this.state : !state
                if(state==0)
                {
                    settings.inputs.each(function(i){
                        $(settings.texts[i]).text('')
                        $(this).parent().show()
                        $(this).val(this.dataset.previousvalue).change();
                    })

                    settings.actionSection.find('[data-state=0]').addClass('hidden')
                    settings.actionSection.find('[data-state=1]').removeClass('hidden')
                    this.state=1
                }
                else{
                    settings.inputs.each(function(i){
                        $(settings.texts[i]).text(this.dataset.text)
                        $(this).parent().hide()
                    })
                    
                    settings.actionSection.find('[data-state=0]').removeClass('hidden')
                    settings.actionSection.find('[data-state=1]').addClass('hidden')
                    this.state=0
                }
            },
            initInput: function(){
                settings.inputs.each(function(){
                    let $elem = $(this)
                    let val=$elem.val()
                    let text
                    if($elem.is('input')){
                        val=val.replaceAll(/\s\s|\s+$/gi, '');
                        text=val
                    }else if($elem.is('select')){
                        text=$elem.find('option:selected').text()
                    }
                    $elem.attr('data-previousvalue',val);
                    $elem.attr('data-text',text);
                })
            }
        }

        settings.actionSection.find('button').each(function(){
            $(this).attr('data-myformindex', index);
        })

        this.mft.initInput()

        this.mft.toggle(0)

        window.mft.push(this.mft)
 
        return this;
 
    };
 
}( jQuery ));