( function(){

    $(function () {

        $('.search').each(function () {

            new Search( $(this) );

        } );

    } );

    var Search = function (obj) {

        //private properties
        var _obj = obj,
            _input = _obj.find('input[type=search]'),
            _request = new XMLHttpRequest(),
            _path = _obj.data('action'),
            suggestSelected = 0,
            countItems = 0,
            valueInput = _input.val(),
            _result = _obj.find('.search__result');

        //private methods

        var _addEvents = function () {

                _input.on( {
                    keyup: function(I) {

                        switch(I.keyCode) {
                            case 13:

                                if( _result.find(' li').filter('.active').length == 0 ) {
                                    _obj.submit();
                                }

                                break;
                            case 32:
                            case 27:
                            case 37:
                            case 38:
                            case 39:
                            case 40:
                                break;
                            default:

                                var valueInput = $(this).val();
                                var count = 0;

                                if( valueInput.length > 0 ){

                                    _ajaxRequest( $(this), valueInput.length);

                                } else {

                                    if( $(this).val() == '' ){
                                        _result.removeClass('visible');
                                        suggestSelected = 0;
                                    }

                                }

                                break;
                        }

                    },
                    keydown: function(I) {

                        switch( I.keyCode ) {
                            case 13:

                                if( _result.find(' li').filter('.active').length ) {

                                    window.location.href = _result.find('li').filter('.active').find('a').attr('href');

                                }
                                return false;
                                break;

                            case 27:
                                _result.removeClass('visible');
                                _result.html('');
                                suggestSelected = 0;
                                return false;
                                break;

                            case 38:
                            case 40:
                                I.preventDefault();

                                if( countItems > 0 ){
                                    _keyActivate( I.keyCode );

                                    if( suggestSelected == countItems){
                                        suggestSelected = 0
                                    }

                                }

                                break;
                        }
                        
                    }

                } );
                $('html').click( function() {

                    _result.removeClass('visible');

                    suggestSelected = 0;

                } );
                $(document).on(
                    "click",
                    "body",
                    function( event ){
                        event = event || window.event;

                        if (event.stopPropagation) {
                            event.stopPropagation();
                        } else {
                            event.cancelBubble = true;
                        }
                    }
                );
                $(document).on(
                    "click",
                    ".search__result li",
                    function() {
                        var curItem = $(this),
                            curText = curItem.find('a').text();

                        _input.val(curText);
                        _result.removeClass('visible');
                        suggestSelected = 0;
                    }
                );
                $(document).on(
                    "keydown",
                    ".search__result li",
                    function(I){
                        switch(I.keyCode) {
                            case 13:

                                $(this).trigger('click');
                                break;
                        }
                    }
                );

            },
            _keyActivate = function(n) {

                _result.find('li').removeClass('active');

                if( n == 40 && suggestSelected < countItems ) {

                    suggestSelected++;

                } else if ( n == 38 && suggestSelected > 0 ) {

                    suggestSelected--;
                }

                if( suggestSelected > 0 ) {

                    _result.find('li').eq( suggestSelected - 1 ).addClass('active');
                    _input.val( _result.find('li').eq( suggestSelected - 1 ).find('a').text() );

                } else {

                    _input.val( valueInput );

                }

            },
            _addData = function( data ) {

                var msg = data;

                _result.html('');
                _result.addClass('visible');

                $.each( msg, function() {

                    var item = this;
                    _result.append('<li><a>'+ item +'</a></li>');

                } );

                countItems = _result.find('li').length;
                _illumination();

            },
            _ajaxRequest =  function( input, n ) {

                _request.abort();
                _request = $.ajax( {
                    url: _path,
                    data: {
                        value: _obj.serialize(),
                        action: 'main_search'
                    },
                    dataType: 'json',
                    type: "get",
                    success: function ( msg ) {

                        if( Object.keys(msg).length != 0 ) {
                            _addData( msg );
                        }

                    },
                    error: function (XMLHttpRequest) {
                        if (XMLHttpRequest.statusText != "abort") {
                            console.log("Error");
                        }
                    }
                });

                return false;
            },
            _illumination = function () {

                var searchItems = _obj.find( '.search__result li a' );

                searchItems.each( function () {

                    $( this ).html(function( _, html ) {
                        return html.replace( new RegExp( _input.val().toLowerCase(), 'i\g' ), '<b>$&</b>' )
                    } );

                } );

            },
            _init = function () {
                _addEvents();
            };

        //public properties

        //public methods

        _init();
    };

} )();