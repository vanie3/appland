/**
 * Custom Gallery Setting
 */
( function( $ ) {
    var media = wp.media;

    // Wrap the render() function to append controls
    media.view.Settings.Gallery = media.view.Settings.Gallery.extend({
        render: function() {
            media.view.Settings.prototype.render.apply( this, arguments );

            // Append the custom template
            this.$el.append( media.template( 'custom-gallery-setting' ) );

            // Save the setting
            media.gallery.defaults.rows = 2;
            this.update.apply( this, ['rows'] );
            return this;
        }
    } );


  /*  wp.media.view.Attachment.Details = wp.media.view.Attachment.Details.extend({
        template: function(view){
          return wp.media.template('attachment')(view)
               + wp.media.template('custom-attachment-settings')(view);
        }*/
        /*initialize: function(){
            // Always make sure that our content is up to date.
           // console.log('fetching model');
           // that = this;
          //  this.model.fetch({success: function (model, response) { console.log(model);
          //    that.render();
          // }});
            wp.media.view.Attachment.prototype.render.apply(this, arguments);
            this.$el.append(wp.media.template('custom-attachment-settings')(this.model.toJSON()));
            this.model.fetch();
            this.model.on('change', this.render, this); console.log(this.model);
        },
        render: function() {
            wp.media.view.Attachment.prototype.render.apply(this, arguments);
            this.views.detach();
            this.$el.append(wp.media.template('custom-attachment-settings')(this.model.toJSON()));
            this.model.fetch();
            this.views.render();


            return this;
        },*/
        /*updateSetting: function( event ) { console.log('saving setting!!!1!');
            var $setting = $( event.target ).closest('[data-setting]'),
                setting, value;

            if ( ! $setting.length )
                return;

            setting = $setting.data('setting');
            value   = event.target.value;

            if ( this.model.get( setting ) !== value ){
                console.log(value); console.log(setting);
                this.save( setting, value );
                this.updateAll();
            }
        }
    });*/

} )( jQuery );