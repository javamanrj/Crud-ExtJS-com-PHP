Ext.define('CrudExt.view.usuario.Form', {

	extend: 'Ext.form.Panel',
	requires: [
				'Ext.form.Field'
			  ],
	defaultType: 'textfield',
	defaults: {
		allowBlank: false,
		labelAlign: 'left',
		labelWidth: 150
	},
	alias: 'widget.usuarioform',

	padding: 5,
	style: 'background-color: #fff;',
	border: false,

	initComponent: function(){

		this.items = [
			{
				name: 'nome',
				fieldLabel: 'Nome'
			},
			{
				name: 'email',
				fieldLabel: 'E-mail',
				vtype: 'email'
			}
		];

		this.bbar = [
			{
				text: 'Salvar',
				action: 'save',
				itemId: 'salvar',
				iconCls: 'save'
			},
			{
				text: 'Cancelar',
				action: 'cancel',
				itemId: 'cancelar',
				iconCls: 'cancel',
				handler: function(){
					this.up('window').close();
				}
			}
		];
			
		this.callParent(arguments);
	}
});