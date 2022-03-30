
/*
 * Editor client script for DB table fxwx_customers
 * Created by http://editor.datatables.net/generator
 */

(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		ajax: 'php/table.fxwx_customers.php',
		table: '#fxwx_customers',
		fields: [
			{
				"label": "shop_id:",
				"name": "shop_id"
			},
			{
				"label": "notes:",
				"name": "notes"
			},
			{
				"label": "status:",
				"name": "status"
			},
			{
				"label": "created_on:",
				"name": "created_on",
				"type": "datetime",
				"format": "YYYY-MM-DD HH:mm:ss"
			},
			{
				"label": "created_by_user_id:",
				"name": "created_by_user_id"
			},
			{
				"label": "updated_on:",
				"name": "updated_on",
				"type": "datetime",
				"format": "YYYY-MM-DD HH:mm:ss"
			},
			{
				"label": "updated_by_user_id:",
				"name": "updated_by_user_id"
			},
			{
				"label": "language_pref:",
				"name": "language_pref"
			},
			{
				"label": "prefix:",
				"name": "prefix"
			},
			{
				"label": "firstname:",
				"name": "firstname"
			},
			{
				"label": "lastname:",
				"name": "lastname"
			},
			{
				"label": "postfix:",
				"name": "postfix"
			},
			{
				"label": "address1:",
				"name": "address1"
			},
			{
				"label": "address2:",
				"name": "address2"
			},
			{
				"label": "address3:",
				"name": "address3"
			},
			{
				"label": "city:",
				"name": "city"
			},
			{
				"label": "state:",
				"name": "state"
			},
			{
				"label": "postalcode:",
				"name": "postalcode"
			},
			{
				"label": "country:",
				"name": "country"
			},
			{
				"label": "phone1:",
				"name": "phone1"
			},
			{
				"label": "phone2:",
				"name": "phone2"
			},
			{
				"label": "phone3:",
				"name": "phone3"
			},
			{
				"label": "phone4:",
				"name": "phone4"
			},
			{
				"label": "phone5:",
				"name": "phone5"
			},
			{
				"label": "phone6:",
				"name": "phone6"
			},
			{
				"label": "can_sms:",
				"name": "can_sms"
			},
			{
				"label": "email:",
				"name": "email"
			}
		]
	} );

	var table = $('#fxwx_customers').DataTable( {
		dom: 'Bfrtip',
		ajax: 'php/table.fxwx_customers.php',
		columns: [
			{
				"data": "shop_id"
			},
			{
				"data": "notes"
			},
			{
				"data": "status"
			},
			{
				"data": "created_on"
			},
			{
				"data": "created_by_user_id"
			},
			{
				"data": "updated_on"
			},
			{
				"data": "updated_by_user_id"
			},
			{
				"data": "language_pref"
			},
			{
				"data": "prefix"
			},
			{
				"data": "firstname"
			},
			{
				"data": "lastname"
			},
			{
				"data": "postfix"
			},
			{
				"data": "address1"
			},
			{
				"data": "address2"
			},
			{
				"data": "address3"
			},
			{
				"data": "city"
			},
			{
				"data": "state"
			},
			{
				"data": "postalcode"
			},
			{
				"data": "country"
			},
			{
				"data": "phone1"
			},
			{
				"data": "phone2"
			},
			{
				"data": "phone3"
			},
			{
				"data": "phone4"
			},
			{
				"data": "phone5"
			},
			{
				"data": "phone6"
			},
			{
				"data": "can_sms"
			},
			{
				"data": "email"
			}
		],
		select: true,
		lengthChange: false,
		buttons: [
			{ extend: 'create', editor: editor },
			{ extend: 'edit',   editor: editor },
			{ extend: 'remove', editor: editor }
		]
	} );
} );

}(jQuery));

