<?php
class PageFactory
{
	function createPage($page)
	{
		if(require_once(SITE_DIR."_common/_page.php"))	//include & check that was included
		{
			if($page)
			{
				switch($page === 0 ? '' : $page)
				{
					//admin pages - these are all ANONYMOUS_USER as they are protected by .htaccess pwd
					case 'a1':
						$pg = new SystemPage($page, '_pages/_add_new_pdf.php', 'Add new document',ANONYMOUS_USER);
						break;
					case 'a2':
						$pg = new SystemPage($page, '_pages/_manage_pdf_docs.php', 'Manage documents', ANONYMOUS_USER);
						break;			
					case 'a3':
						$pg = new SystemPage($page, '_pages/_add_new_pdf.php', 'Edit document', ANONYMOUS_USER);
						break;
					case 'a4':
						$pg = new SystemPage($page, '_pages/_edit_member_administrator.php', 'Edit members/administrators', ANONYMOUS_USER);
						break;
					case 'a5':
						$pg = new SystemPage($page, '_pages/_employee_update.php', 'Employee Update', ANONYMOUS_USER);
						break;
					case 'a6':
						$pg = new SystemPage($page, '_pages/_admin_employee_update.php', 'Administrator Update', ANONYMOUS_USER);
						break;
					case 'a7':
						$pg = new SystemPage($page, '_pages/_content_pages.php', 'Manage pages', ANONYMOUS_USER);
						break;
					case 'a8':
						$pg = new SystemPage($page, '_pages/_new_section.php', 'Add new section', ANONYMOUS_USER);
						break;
					case 'a9':
						$pg = new SystemPage($page, '_pages/_new_section_2.php', 'Add new section', ANONYMOUS_USER);
						break;
					case 'a10':
						$pg = new SystemPage($page, '_pages/_new_page.php', 'Edit page', ANONYMOUS_USER);
						break;
					case 'a11':
						$pg = new SystemPage($page, '_pages/_edit_administrator.php', 'Edit agency details', ANONYMOUS_USER);
						break;
					case 'a12':
						$pg = new SystemPage($page, '_pages/_edit_member.php', 'Edit member details', ANONYMOUS_USER);
						break;												
					case 'a14':
						$pg = new SystemPage($page, '_pages/_admin_employee_update_add_edit.php', 'Update story', ANONYMOUS_USER);
						break;
					case 'a15':
						$pg = new SystemPage($page, '_pages/_admin_employee_update_add_edit.php', 'Update story', ANONYMOUS_USER);
						break;
					case 'a16':
						$pg = new SystemPage($page, '_pages/_admin_employee_update_add_edit.php', 'Update story', ANONYMOUS_USER);
						break;
					case 'a17':
						$pg = new SystemPage($page, '_pages/_admin_employee_update_add_edit.php', 'Update story', ANONYMOUS_USER);
						break;
					case 'a18':
						$pg = new SystemPage($page, '_pages/_new_page.php', 'Add page', ANONYMOUS_USER);
						break;						
					//end admin pages
					
					//front-end pages - these are assigned user types as there are different types on the front end							
					case 'f1':
						$pg = new SystemPage($page, '_pages/_member_login.php', 'Member login', ANONYMOUS_USER);
						break;
					case 'f2':
						$pg = new SystemPage($page, '_pages/_admin_login.php', 'Administrator login', ANONYMOUS_USER);
						break;
					case 'f3':
						$pg = new SystemPage($page, '_pages/_member_home.php', 'Member\'s home', MEMBER_USER);
						break;
					case 'f4':
						$pg = new SystemPage($page, '_pages/_admin_home.php', 'Administrator\'s home', ADMINISTRATOR_USER);
						break;											
					case 'f5':
						$pg = new SystemPage($page, '_pages/_member_employee_update.php', 'Employee Update', ADMINISTRATOR_USER);
						break;
					case 'f6':
						$pg = new SystemPage($page, '_pages/_administrator_update.php', 'Administrator Update', ADMINISTRATOR_USER);
						break;
					case 'f7':
						$pg = new SystemPage($page, '_pages/_admin_documents_and_forms.php', 'Documents & forms', ADMINISTRATOR_USER);
						break;
					case 'f8':
						$pg = new SystemPage($page, '_pages/_admin_information_sheets.php', 'Documents & forms', ADMINISTRATOR_USER);
						break;
					case 'f9':
						$pg = new SystemPage($page, '_pages/_edit_administrator.php', 'Change contact details', ADMINISTRATOR_USER);
						break;
					case 'f10':
						$pg = new SystemPage($page, '_pages/_member_documents_and_forms.php', 'Documents & forms', MEMBER_USER);
						break;												
					case 'f11':
						$pg = new SystemPage($page, '_pages/_member_employee_update.php', 'Employee Update', MEMBER_USER);
						break;
					case 'f12':
						$pg = new SystemPage($page, '_pages/_member_account_balance.php', 'Account balance', MEMBER_USER);
						break;
					case 'f14':
						$pg = new SystemPage($page, '_pages/_member_account_statement.php', 'Account statement', MEMBER_USER);
						break;
					case 'f15':
						$pg = new SystemPage($page, '_pages/_member_change_contact_details.php', 'Change contact details', MEMBER_USER);
						break;						
					case 'f16':
						$pg = new SystemPage($page, '_pages/_statement', 'Statement', MEMBER_USER);
						break;
					case 'f17':
						$pg = new SystemPage($page, '_pages/_member_and_admin_login.php', 'Member and Admin login', ANONYMOUS_USER);
						break;
					case 'f18':
						$pg = new SystemPage($page, '_pages/_customer_survey.php', 'Customer Survey', MEMBER_USER);
						break;
					case 'f19':
						$pg = new SystemPage($page, '_pages/_confirm_survey.php', 'Customer Survey', MEMBER_USER);
						break;					
					case 'f20':
						$pg = new SystemPage($page, '_pages/_forgot_password.php', 'Forgot Password', ANONYMOUS_USER);
						break;				
					//end front-end pages
										
					
					//end temp pages			
					case '':
						$pg = new SystemPage($page, '_user_pages/home.php', 'Home', ANONYMOUS_USER);
						break;
					
					case 'currentvac':
						$pg = new SystemPage($page, '_user_pages/current_vacancies_1.php', 'Current Vacancies', ANONYMOUS_USER);
						break;	
					
					default:
						$pg = new UserPage();

						$pg->id = $page;						
						$pg->findById();
						break;
				}
			}
			else
			{
				$pg = new SystemPage($page, '_user_pages/home.php', 'Home', ANONYMOUS_USER);
			}
		}
		else
		{
			trigger_error('Include page not found.', E_USER_ERROR);
		}			
		return $pg;
	}
}
?>