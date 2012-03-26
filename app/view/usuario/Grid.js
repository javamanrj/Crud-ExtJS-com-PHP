Ext.define('CrudExt.view.usuario.Grid',{
	extend: 'Ext.grid.Panel',
	title		: 'Lista de usuários',
	itemId		: 'usuarioGrid',
	xtype		: 'usuariogrid',
	store 		: 'Usuarios',

	initComponent: function(){

		this.columns = [
			{ header: 'Id',  dataIndex: 'id' },
	        { header: 'Nome', dataIndex: 'nome'},
	        { header: 'Email', dataIndex: 'email' }
		];

		this.dockedItems = [
			{
				xtype: 'toolbar',
				dock: 'top',
				items: [
					{
						xtype: 'button',
						text: 'Adicionar usuário',
						iconCls: 'add',
						action: 'add'
					},
					{
						text: 'Deletar usuário',
						iconCls: 'delete',
						action: 'delete'
					},
					{
						text: 'Editar usuário',
						iconCls: 'edit',
						action: 'edit'
					}
				]
			},
			{
		        xtype: 'pagingtoolbar',
		        store: 'Usuarios',
		        dock: 'bottom',
		        displayInfo: true
		    }
		];

		this.callParent(arguments);
	}

});