var table = function( presenterPath )
{
    window.gcd.core.mvp.viewBridgeClasses.JqueryHtmlViewBridge.apply( this, arguments );
};

table.prototype = new window.gcd.core.mvp.viewBridgeClasses.JqueryHtmlViewBridge();
table.prototype.constructor = table;

table.prototype.attachEvents = function()
{
    var self = this;

    this.element.find( 'thead th.sortable' ).click( function()
    {
        var index = $.inArray( this, $( 'thead th' ) );

        self.raiseServerEvent( 'ColumnClicked', index );
    } );

    this.element.find( 'tbody tr td.clickable' ).click( function()
    {
		var tr = $( this ).parents( 'tr:first' );

        self.raiseClientEvent( 'RowClicked', tr );
    } );
};

window.gcd.core.mvp.viewBridgeClasses.TableViewBridge = table;