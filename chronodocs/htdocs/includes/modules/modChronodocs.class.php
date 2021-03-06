<?php
/* Copyright (C) 2003      Rodolphe Quiedeville <rodolphe@quiedeville.org>
 * Copyright (C) 2004-2008 Laurent Destailleur  <eldy@users.sourceforge.net>
 * Copyright (C) 2008      Raphael Bertrand (Resultic) <raphael.bertrand@resultic.fr>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
 */

/**     \defgroup   chronodocs     Module Chronodocs
 *		\brief      Example of a module descriptor.
 *					Such a file must be copied into htdocs/includes/module directory.
 */

/**
 *	\file       htdocs/includes/modules/modChronodocs.class.php
 *	\ingroup    chronodocs
 *	\brief      Description and activation file for module Chronodocs
 *	\version	$Id: modChronodocs.class.php,v 1.9 2010/08/09 14:56:29 eldy Exp $
 */

include_once(DOL_DOCUMENT_ROOT ."/includes/modules/DolibarrModules.class.php");


/**     \class      modChronodocs
 *		\brief      Description and activation class for module Chronodocs
 */
class modChronodocs extends DolibarrModules
{

	/**
	 *   \brief      Constructor. Define names, constants, directories, boxes, permissions
	 *   \param      DB      Database handler
	 */
	function modChronodocs($DB)
	{
		$this->db = $DB;

		// Id for module (must be unique).
		// Use here a free id (See in Home -> System information -> Dolibarr for list of used module id).
		$this->numero = 2600;
		// Key text used to identify module (for permission, menus, etc...)
		$this->rights_class = 'chronodocs';

		// Family can be 'crm','financial','hr','projects','product','ecm','technic','other'
		// It is used to group modules in module setup page
		$this->family = "ecm";
		// Module label (no space allowed), used if translation string 'ModuleXXXName' not found (where XXX is value of numeric property 'numero' of module)
		$this->name = preg_replace('/^mod/i','',get_class($this));
		// Module description used if translation string 'ModuleXXXDesc' not found (where XXX is value of numeric property 'numero' of module)
		$this->description = "Module de gestion de documents a numero chrono";
		// Possible values for version are: 'development', 'experimental', 'dolibarr' or version
		$this->version = '1.0';
		// Key used in llx_const table to save module status enabled/disabled
		$this->const_name = 'MAIN_MODULE_'.strtoupper($this->name);
		// Where to store the module in setup page (0=common,1=interface,2=other)
		$this->special = 2;
		// Name of png file (without png) used for this module.
		// Png file must be in theme/yourtheme/img directory under name object_pictovalue.png.
		$this->picto='dir';

		// Data directories to create when module is enabled.
		$this->dirs = array();
		$this->dirs[0] = DOL_DATA_ROOT.'/chronodocs';
		$this->dirs[1] = DOL_DATA_ROOT.'/chronodocs/temp';

		// Relative path to module style sheet if exists. Example: '/chronodocs/mycss.css'.
		$this->style_sheet = '';

		// Config pages. Put here list of php page names stored in admin directory used to setup module.
		$this->config_page_url = array("chronodocs.php@chronodocs");

		// Dependencies
		$this->depends = array("modSociete","modCommercial");		// List of modules id that must be enabled if this module is enabled
		$this->requiredby = array();	// List of modules id to disable if this one is disabled
		$this->phpmin = array(4,1);					// Minimum version of PHP required by module
		$this->need_dolibarr_version = array(2,9);	// Minimum version of Dolibarr required by module
		$this->langfiles = array("@chronodocs");

		// Constants
		$this->const = array();			// List of parameters

		$this->const[1][0] = "CHRONODOCS_ADDON";
		$this->const[1][1] = "chaine";
		$this->const[1][2] = "mod_chronodocs_saphir2";
		$this->const[1][3] = 'Nom du gestionnaire de numerotation des chronodocs';
		$this->const[1][4] = 0;

		$this->const[2][0] = "CHRONODOCS_ADDON_TEMPLATE";
		$this->const[2][1] = "chaine";
		$this->const[2][2] = "wrapper";
		$this->const[2][3] = 'Nom du template de generation des chronodocs';
		$this->const[2][4] = 0;

		// Boxes
		$this->boxes = array();			// List of boxes
		$r=0;

		// Add here list of php file(s) stored in includes/boxes that contains class to show a box.
		// Example:
		//$this->boxes[$r][1] = "myboxa.php";
		//$r++;
		//$this->boxes[$r][1] = "myboxb.php";
		//$r++;

		// Permissions
		$this->rights = array();		// Permission array used by this module
		$r=0;

		// Add here list of permission defined by an id, a label, a boolean and two constant strings.
		// Example:
		// $this->rights[$r][0] = 2000; 				// Permission id (must not be already used)
		// $this->rights[$r][1] = 'Permision label';	// Permission label
		// $this->rights[$r][3] = 1; 					// Permission by default for new user (0/1)
		// $this->rights[$r][4] = 'level1';				// In php code, permission will be checked by test if ($user->rights->permkey->level1->level2)
		// $this->rights[$r][5] = 'level2';				// In php code, permission will be checked by test if ($user->rights->permkey->level1->level2)
		// $r++;

		$this->rights[$r][0] = 2600; 				// Permission id (must not be already used)
		$this->rights[$r][1] = 'Read chronodocs';	// Permission label
		$this->rights[$r][3] = 1; 					// Permission by default for new user (0/1)
		$this->rights[$r][4] = 'entries';		// In php code, permission will be checked by test if ($user->rights->permkey->level1->level2)
		$this->rights[$r][5] = 'read';				// In php code, permission will be checked by test if ($user->rights->permkey->level1->level2)
		$r++;

		$this->rights[$r][0] = 2601; 				// Permission id (must not be already used)
		$this->rights[$r][1] = 'Write chronodocs (Create/Edit)';	// Permission label
		$this->rights[$r][3] = 0; 					// Permission by default for new user (0/1)
		$this->rights[$r][4] = 'entries';		// In php code, permission will be checked by test if ($user->rights->permkey->level1->level2)
		$this->rights[$r][5] = 'write';			// In php code, permission will be checked by test if ($user->rights->permkey->level1->level2)
		$r++;

		$this->rights[$r][0] = 2602; 				// Permission id (must not be already used)
		$this->rights[$r][1] = 'Delete chronodocs';	// Permission label
		$this->rights[$r][3] = 0; 					// Permission by default for new user (0/1)
		$this->rights[$r][4] = 'entries';			// In php code, permission will be checked by test if ($user->rights->permkey->level1->level2)
		$this->rights[$r][5] = 'delete';			// In php code, permission will be checked by test if ($user->rights->permkey->level1->level2)
		$r++;

		$this->rights[$r][0] = 2603; 				// Permission id (must not be already used)
		$this->rights[$r][1] = 'Read chronodocs_types details';	// Permission label
		$this->rights[$r][3] = 0; 					// Permission by default for new user (0/1)
		$this->rights[$r][4] = 'types';			// In php code, permission will be checked by test if ($user->rights->permkey->level1->level2)
		$this->rights[$r][5] = 'read';			// In php code, permission will be checked by test if ($user->rights->permkey->level1->level2)
		$r++;

		$this->rights[$r][0] = 2604; 				// Permission id (must not be already used)
		$this->rights[$r][1] = 'Write chronodocs_types (Create/Edit)';	// Permission label
		$this->rights[$r][3] = 0; 					// Permission by default for new user (0/1)
		$this->rights[$r][4] = 'types';			// In php code, permission will be checked by test if ($user->rights->permkey->level1->level2)
		$this->rights[$r][5] = 'write';			// In php code, permission will be checked by test if ($user->rights->permkey->level1->level2)
		$r++;

		$this->rights[$r][0] = 2605; 				// Permission id (must not be already used)
		$this->rights[$r][1] = 'Delete chronodocs_types';	// Permission label
		$this->rights[$r][3] = 0; 					// Permission by default for new user (0/1)
		$this->rights[$r][4] = 'types';			// In php code, permission will be checked by test if ($user->rights->permkey->level1->level2)
		$this->rights[$r][5] = 'delete';			// In php code, permission will be checked by test if ($user->rights->permkey->level1->level2)
		$r++;

		// Exports
		$r=1;

		// $this->export_code[$r]=$this->rights_class.'_'.$r;
		// $this->export_label[$r]='CustomersInvoicesAndInvoiceLines';	// Translation key (used only if key ExportDataset_xxx_z not found)
		// $this->export_permission[$r]=array(array("facture","facture","export"));
		// $this->export_fields_array[$r]=array('s.rowid'=>"IdCompany",'s.nom'=>'CompanyName','s.address'=>'Address','s.cp'=>'Zip','s.ville'=>'Town','s.fk_pays'=>'Country','s.tel'=>'Phone','s.siren'=>'ProfId1','s.siret'=>'ProfId2','s.ape'=>'ProfId3','s.idprof4'=>'ProfId4','s.code_compta'=>'CustomerAccountancyCode','s.code_compta_fournisseur'=>'SupplierAccountancyCode','f.rowid'=>"InvoiceId",'f.facnumber'=>"InvoiceRef",'f.datec'=>"InvoiceDateCreation",'f.datef'=>"DateInvoice",'f.total'=>"TotalHT",'f.total_ttc'=>"TotalTTC",'f.tva'=>"TotalVAT",'f.paye'=>"InvoicePayed",'f.fk_statut'=>'InvoiceStatus','f.note'=>"InvoiceNote",'fd.rowid'=>'LineId','fd.description'=>"LineDescription",'fd.price'=>"LineUnitPrice",'fd.tva_taux'=>"LineVATRate",'fd.qty'=>"LineQty",'fd.total_ht'=>"LineTotalHT",'fd.total_tva'=>"LineTotalTVA",'fd.total_ttc'=>"LineTotalTTC",'fd.date_start'=>"DateStart",'fd.date_end'=>"DateEnd",'fd.fk_product'=>'ProductId','p.ref'=>'ProductRef');
		// $this->export_entities_array[$r]=array('s.rowid'=>"company",'s.nom'=>'company','s.address'=>'company','s.cp'=>'company','s.ville'=>'company','s.fk_pays'=>'company','s.tel'=>'company','s.siren'=>'company','s.siret'=>'company','s.ape'=>'company','s.idprof4'=>'company','s.code_compta'=>'company','s.code_compta_fournisseur'=>'company','f.rowid'=>"invoice",'f.facnumber'=>"invoice",'f.datec'=>"invoice",'f.datef'=>"invoice",'f.total'=>"invoice",'f.total_ttc'=>"invoice",'f.tva'=>"invoice",'f.paye'=>"invoice",'f.fk_statut'=>'invoice','f.note'=>"invoice",'fd.rowid'=>'invoice_line','fd.description'=>"invoice_line",'fd.price'=>"invoice_line",'fd.total_ht'=>"invoice_line",'fd.total_tva'=>"invoice_line",'fd.total_ttc'=>"invoice_line",'fd.tva_taux'=>"invoice_line",'fd.qty'=>"invoice_line",'fd.date_start'=>"invoice_line",'fd.date_end'=>"invoice_line",'fd.fk_product'=>'product','p.ref'=>'product');
		// $this->export_alias_array[$r]=array('s.rowid'=>"socid",'s.nom'=>'soc_name','s.address'=>'soc_adres','s.cp'=>'soc_zip','s.ville'=>'soc_ville','s.fk_pays'=>'soc_pays','s.tel'=>'soc_tel','s.siren'=>'soc_siren','s.siret'=>'soc_siret','s.ape'=>'soc_ape','s.idprof4'=>'soc_idprof4','s.code_compta'=>'soc_customer_accountancy','s.code_compta_fournisseur'=>'soc_supplier_accountancy','f.rowid'=>"invoiceid",'f.facnumber'=>"ref",'f.datec'=>"datecreation",'f.datef'=>"dateinvoice",'f.total'=>"totalht",'f.total_ttc'=>"totalttc",'f.tva'=>"totalvat",'f.paye'=>"paid",'f.fk_statut'=>'status','f.note'=>"note",'fd.rowid'=>'lineid','fd.description'=>"linedescription",'fd.price'=>"lineprice",'fd.total_ht'=>"linetotalht",'fd.total_tva'=>"linetotaltva",'fd.total_ttc'=>"linetotalttc",'fd.tva_taux'=>"linevatrate",'fd.qty'=>"lineqty",'fd.date_start'=>"linedatestart",'fd.date_end'=>"linedateend",'fd.fk_product'=>'productid','p.ref'=>'productref');
		// $this->export_sql_start[$r]='SELECT DISTINCT ';
		// $this->export_sql_end[$r]  =' FROM ('.MAIN_DB_PREFIX.'facture as f, '.MAIN_DB_PREFIX.'facturedet as fd, '.MAIN_DB_PREFIX.'societe as s)';
		// $this->export_sql_end[$r] .=' LEFT JOIN '.MAIN_DB_PREFIX.'product as p on (fd.fk_product = p.rowid)';
		// $this->export_sql_end[$r] .=' WHERE f.fk_soc = s.rowid AND f.rowid = fd.fk_facture';
		// $r++;


		// Main menu entries
		$this->menus = array();			// List of menus to add
		$r=0;

		// Example:
		// This is to declare the Top Menu entry:
		// $this->menu[$r]=array(	'fk_menu'=>0,			// Put 0 if this is a top menu
		//							'type'=>'top',			// This is a Top menu entry
		//							'titre'=>'Title top menu',
		//							'mainmenu'=>'chronodocs',
		//							'leftmenu'=>'1',		// Use 1 if you also want to add left menu entries using this descriptor. Use 0 if left menu entries are defined in a file pre.inc.php (old school).
		//							'url'=>'/comm/action/index.php',
		//							'langs'=>'mylangfile',	// Lang file to use (without .lang) by module
		//							'position'=>100,
		//							'perms'=>'$user->rights->chronodocs->level1->level2',		// Use 'perms'=>'1' if you want your menu with no permission rules
		//							'target'=>'',
		//							'user'=>0);				// 0=menu for all users
		// $r++;
		//
		// This is to declare a Left Menu entry:
		// $this->menu[$r]=array(	'fk_menu'=>'r=0',		// Use r=value where r is index key used for the top menu entry
		//							'type'=>'left',			// This is a Left menu entry
		//							'titre'=>'Title left menu',
		//							'mainmenu'=>'chronodocs',
		//							'url'=>'/comm/action/index2.php',
		//							'langs'=>'mylangfile',	// Lang file to use (without .lang) by module
		//							'position'=>100,
		//							'perms'=>'$user->rights->chronodocs->level1->level2',		// Use 'perms'=>'1' if you want your menu with no permission rules
		//							'target'=>'',
		//							'user'=>0);				// 0=menu for all users
		// $r++;

		$this->menu[$r]=array(	'fk_menu'=>0,			// Put 0 if this is a top menu
									'type'=>'top',			// This is a Top menu entry
									'titre'=>'Chronodocs',
									'mainmenu'=>'chronodocs',
									'leftmenu'=>'1',		// Use 1 if you also want to add left menu entries using this descriptor. Use 0 if left menu entries are defined in a file pre.inc.php (old school).
									'url'=>'/chronodocs/index.php',
									'langs'=>'chronodocs',	// Lang file to use (without .lang) by module
									'position'=>100,
									'perms'=>'$user->rights->chronodocs->entries->read',		// Use 'perms'=>'1' if you want your menu with no permission rules
									'target'=>'',
									'user'=>0);				// 0=menu for all users
		$r++;

		$this->menu[$r]=array(	'fk_menu'=>'r=0',		// Use r=value where r is index key used for the top menu entry
									'type'=>'left',			// This is a Left menu entry
									'titre'=>'Liste chronodocs',
									'mainmenu'=>'chronodocs',
									'url'=>'/chronodocs/index.php',
									'langs'=>'chronodocs',	// Lang file to use (without .lang) by module
									'position'=>100,
									'perms'=>'$user->rights->chronodocs->entries->read',		// Use 'perms'=>'1' if you want your menu with no permission rules
									'target'=>'',
									'user'=>0);				// 0=menu for all users
		$r++;

		$this->menu[$r]=array(	'fk_menu'=>'r=0',		// Use r=value where r is index key used for the top menu entry
									'type'=>'left',			// This is a Left menu entry
									'titre'=>'Nouveau chronodoc',
									'mainmenu'=>'chronodocs',
									'url'=>'/chronodocs/fiche.php?action=create',
									'langs'=>'chronodocs',	// Lang file to use (without .lang) by module
									'position'=>100,
									'perms'=>'$user->rights->chronodocs->entries->write',		// Use 'perms'=>'1' if you want your menu with no permission rules
									'target'=>'',
									'user'=>0);				// 0=menu for all users
		$r++;

		$this->menu[$r]=array(	'fk_menu'=>'r=0',		// Use r=value where r is index key used for the top menu entry
									'type'=>'left',			// This is a Left menu entry
									'titre'=>'Types chronodoc',
									'mainmenu'=>'chronodocs',
									'url'=>'/chronodocs/types.php',
									'langs'=>'chronodocs',	// Lang file to use (without .lang) by module
									'position'=>100,
									'perms'=>'$user->rights->chronodocs->types->read',		// Use 'perms'=>'1' if you want your menu with no permission rules
									'target'=>'',
									'user'=>0);				// 0=menu for all users
		$r++;

	}

	/**
	 *		\brief      Function called when module is enabled.
	 *					The init function add constants, boxes, permissions and menus (defined in constructor) into Dolibarr database.
	 *					It also creates data directories.
	 *      \return     int             1 if OK, 0 if KO
	 */
	function init()
	{
		$sql = array();

		$result=$this->load_tables();

		$sql[] = "REPLACE INTO `".MAIN_DB_PREFIX."c_type_contact` ( `rowid` , `element` , `source` , `code` , `libelle` , `active` ) VALUES ('2601', 'chronodocs_entries', 'external', 'CUSTOMER', 'Contact client suivi document', '1')";
		$sql[] = "REPLACE INTO `".MAIN_DB_PREFIX."c_type_contact` ( `rowid` , `element` , `source` , `code` , `libelle` , `active` ) VALUES ('2602', 'chronodocs_entries', 'internal', 'AUTHOR', 'Redacteur document', '1')";

		return $this->_init($sql);
	}

	/**
	 *		\brief		Function called when module is disabled.
	 *              	Remove from database constants, boxes and permissions from Dolibarr database.
	 *					Data directories are not deleted.
	 *      \return     int             1 if OK, 0 if KO
	 */
	function remove()
	{
		$sql = array();

		return $this->_remove($sql);
	}


	/**
	 *		\brief		Create tables and keys required by module
	 * 					Files chronodocs.sql and chronodocs.key.sql with create table and create keys
	 * 					commands must be stored in directory /mysql/tables/chronodocs/.
	 *					This function is called by this->init.
	 * 		\return		int		<=0 if KO, >0 if OK
	 */
	function load_tables()
	{
		include_once(DOL_DOCUMENT_ROOT ."/lib/admin.lib.php");

		global $db;

		$ok = 1;
		if ($ok)
		{
			$dir = DOL_DOCUMENT_ROOT.'/chronodocs/sql/';
			$ok = 0;

			// Run llx_mytable.sql files
			$handle=opendir($dir);
			if ($hanlde)
			{
				while (($file = readdir($handle))!==false)
				{
					if (eregi('\.sql$',$file) && substr($file,0,4) == 'llx_' && substr($file, -8) <> '.key.sql')
					{
						$result=run_sql($dir.$file,1);
					}
				}
				closedir($handle);
			}

			// Run llx_mytable.key.sql files
			$handle=opendir($dir);
			if ($hanlde)
			{
				while (($file = readdir($handle))!==false)
				{
					if (eregi('\.sql$',$file) && substr($file,0,4) == 'llx_' && substr($file, -8) == '.key.sql')
					{
						$result=run_sql($dir.$file,1);
					}
				}
				closedir($handle);
			}

			if ($error == 0)
			{
				$ok = 1;
			}
		}

		return $ok;
	}
}

?>
