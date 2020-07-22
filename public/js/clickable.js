/**
 * CLICKABLE JS
 * Author: Adam Lewison
 * Feel free to use
 */

class Clickable {

    constructor(clickable_element, options, callback) {

        /*
            class properties
         */
        this.previous_selected = null;
        this.current_selected = null;
        this.previous_selected_reference = null;
        this.current_selected_reference = null;

        var fillable_style = ['color', 'font-size', 'background-color', 'padding', 'margin' ];
        var tag = $(clickable_element);

        var default_options = {
            action: 'click',
            cursor: 'pointer',
            style: {
                background_color: '#f7f7f7'
            },
            slide_speed: 'slow',
            show_speed: 'slow',
            dont_revert_css: []
        }

        /*
            Populate options with default options of whatever has not been filled in
         */
        if (typeof options == 'undefined') {
            options = default_options
        } else {

            /**
             * Populate style option with defaults
             */

            if (options.hasOwnProperty('style')) {
                Object.keys(default_options.style).forEach(
                    key =>
                    {
                        if (!options.style.hasOwnProperty(key)) {
                            options.style[key] = default_options.style[key];
                        }
                    })
            }

            /**
             * Populate other options with defaults
             */

            Object.keys(default_options).forEach(
                key =>
                {
                    if (!options.hasOwnProperty(key)) {
                        options[key] = default_options[key];
                    } else {
                        if (!this.inputtedSettingIsValid(key, options[key])) {
                            options[key] = default_options[key];
                        }
                    }
            });
        }

        /**
         * Save original styles
         *
         */

        var onClick_style = {};
        var original_style = {};

        var self = this;
        Object.keys(options.style).forEach(function (v,i) {
            onClick_style[v] = options.style[v];
            original_style[v] = tag.css(self.keywordToCss(v));
        });

        options.style = onClick_style;
        options.original_style = original_style;

        /**
         * Convert related anchors to an array
         */
        if (options.hasOwnProperty('related_anchors')) {
            if (typeof options['related_anchors'] == "string") {
                options['related_anchors'] = [options['related_anchors']]
                this.options['related_anchors'] =  options['related_anchors'];
            }
        }

        /**
         * Control CSS
         */
        self = this;

        if (options.cursor != 'off') {
            $(clickable_element).css('cursor', options.cursor);
        }

        /**
         *   Assign ID to clickable elements
         */
        $(clickable_element).each(function (index) {
            $(this).attr('data-Clickable-id', index);
        })

        /**
         *  Assign local variables to properties
         */
        this.clickable_element = clickable_element;
        this.options = options;
        this.callback = callback;
        console.log(options)

        /**
         *   Activate action listener
         */
        this.actionListener();
    }

    onClick(tag) {

        this.previous_selected_reference = this.current_selected_reference;
        this.current_selected_reference = tag;


        tag = $(tag);
        this.previous_selected = this.current_selected;
        this.current_selected = tag;

        /**
         * If something else is selected
         */
        if (this.previous_selected != null) {
            if (this.current_selected.attr('data-Clickable-id') == this.previous_selected.attr('data-Clickable-id')) {
                // If that something else is the one im currently selecting
                this.removeSelected(this.current_selected);
                this.current_selected = null;
                this.previous_selected = null;
            } else {
                // Selecting a different element
                this.removeSelected(this.previous_selected)
                this.makeSelected(this.current_selected);
            }
        } else {
            this.makeSelected(this.current_selected);
        }

        return [this.previous_selected_reference, this.current_selected_reference]
    }

    removeSelected(tag) {
        var options = this.options;

        /**
         *  Undo the css of the properties defined in options.style
         */
        var self = this;
        Object.keys(options.original_style).forEach(function (v,i) {
            if (!options.dont_revert_css.includes(self.keywordToCss(v))) {
                tag.css(self.keywordToCss(v), options.original_style[v]);
            }
        });

        /**
         * Deactivate links
         */
        if (tag[0].hasAttribute('data-clickable-activate')) {
            /**
             * data-clickable-activate = a#delete:/delete/21&&button#edit:/projects/20
             */
            var activateArr = tag.attr('data-clickable-activate').split('&&');

            activateArr.forEach(function (v,i) {
                self.toggleActivate(v);
            });
        }

        /**
         * Hide the displayed
         */
        if (tag[0].hasAttribute('data-clickable-show')) {
            var showArr = tag.attr('data-clickable-show').split('&&');
            showArr.forEach(function (v,i) {
                self.findTargetTag(v, tag).hide(options.show_speed);
            });
        }

        /**
         * Slide the displayed
         */
        if (tag[0].hasAttribute('data-clickable-slide')) {

            var showArr = tag.attr('data-clickable-slide').split('&&');

            showArr.forEach(function (v,i) {
                self.findTargetTag(v, tag).slideToggle(options.slide_speed);
            });
        }
    }

    makeSelected(tag) {
        var options = this.options;

        /**
         *  Change the css of the properties defined in options.style
         */
        var self = this;
        Object.keys(options.style).forEach(function (v,i) {
            tag.css(self.keywordToCss(v), options.style[v]);
        });

        /**
         * Activate links
         */
        if (tag[0].hasAttribute('data-clickable-activate')) {

            /**
             * data-clickable-activate = a#delete:/delete/21&&button#edit:/projects/20
             */

            var activateArr = tag.attr('data-clickable-activate').split('&&');

            activateArr.forEach(function (v,i) {
                self.toggleActivate(v);
            });
        }

        /**
         * Display the hidden
         */
        if (tag[0].hasAttribute('data-clickable-show')) {
            /**
             * data-clickable-show = #this&&#this
             */

            var showArr = tag.attr('data-clickable-show').split('&&');

            showArr.forEach(function (v,i) {
               self.findTargetTag(v, tag).show(options.show_speed);
            });
        }

        /**
         * Slide the hidden
         */
        if (tag[0].hasAttribute('data-clickable-slide')) {

            var showArr = tag.attr('data-clickable-slide').split('&&');

            showArr.forEach(function (v,i) {
                self.findTargetTag(v, tag).slideToggle(options.slide_speed);
            });
        }

    }

    inputtedSettingIsValid(key, value) {
        return true;
    }

    keywordToCss(keyword_name) {
        return keyword_name.replace('_', '-');
    }

    cssToKeyword(css_property) {
        return css_property.replace('-', '_');
    }

    toggleActivate(activateCommand) {

        activateCommand = activateCommand.split(':').map(function (a) {
            return a.trim();
        });


        var toggleDisabledClass = [
            $(activateCommand[0]),
            $(activateCommand[0]).find('button')
        ];

        var toggleDisabledAttr = [
            $(activateCommand[0]).find('button')
        ];

        var toggleHref = [
            $(activateCommand[0])
        ];

        toggleDisabledClass.forEach(
            v => {
                if (v.hasClass('disabled')) {
                    v.removeClass('disabled');
                } else {
                    v.addClass('disabled');
                }
            }
        );

        toggleDisabledAttr.forEach(
            v => {
                if (v[0].hasAttribute('disabled')) {
                    v.removeAttr('disabled');
                } else {
                    v.attr('disabled', '');
                }
            }
        );

        toggleHref.forEach(
            v => {
                if (v.attr('href') == activateCommand[1]) {
                    v.attr('href', '#');
                } else {
                    v.attr('href', activateCommand[1]);
                }
            }
        );
    }

    findTargetTag(string, startingTag) {
        //console.log(string,startingTag)
        if (string.startsWith('this/') || string.startsWith('parent/') || string.startsWith('sibling/')) {
            return this.findTargetTagHelper(string, startingTag)
        } else {
            return this.findTargetTagHelper(string, $('body'))
        }

    }

    findTargetTagHelper(string, tag) {
        // string = "this.hello"
        string = string.trim();

        if (string == '') {
            return tag;
        }

        if (string.startsWith('this/')) {
            return this.findTargetTagHelper(string.substring( 'this/'.length ), tag)
        }

        if (string.startsWith('parent/')) {
            return this.findTargetTagHelper(string.substring( 'parent/'.length ), tag.parent())
        }

        if (string.startsWith('sibling/')) {
            return this.findTargetTagHelper(string.substring( 'sibling/'.length ), tag.siblings())
        }

        return tag.find(string);
    }

    toggleCss(tag, property, value) {

        if (tag.css( this.keywordToCss(property) ) == value) {
            tag.css(this.keywordToCss(property), this.options.original_style[property]);
        } else {
            tag.css(this.keywordToCss(property),value);
        }
    }

    actionListener() {
        var self = this;
        console.log('hit')
        $(self.clickable_element).on(self.options.action, function () {
            var references = self.onClick(this);

            /**
             * Callback
             */

            if (typeof self.callback == 'function') {
                self.callback(references[1], references[0]);
            }

        });
    }

}
