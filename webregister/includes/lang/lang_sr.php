<?php
////////////////////////////////////////////////////////////////////////////////////////////
///                                                                                      ///
///  lang_sr.php - Serbian language constants for the PvPGN Web Account Creation Script  ///
///                                                                                      ///
////////////////////////////////////////////////////////////////////////////////////////////

// These are used for the page titles
$language['title'] =			"PvPGN Web skripta za kreranje naloga";
$language['title_activated'] =	"Activacija uspešna";
$language['title_resent'] =		"Activacija zahteva e-mail";
$language['title_waiting'] =	"Nalog čeka activaciju";
$language['title_success'] =	"Uspešno";
$language['title_error'] =		"Greška";
$language['title_sqlerror'] =	"MySQL Greška";

// Activation notices
// Example:  "JoeUser, your account is already awating activation."
$language['alreadywaiting'] = 	", tvoj nalog vec čeka aktivaciju.";

// Example:  "JoeUser, your account has been successfully activated!";
$language['activated'] =		", tvoj nalog je uspešno aktiviran!";

// Similar thing here :-)
$language['created'] =			", tvoj nalog je uspešno kreiran!";

// If someone creates a user account and admin activation is enabled:
$language['waitforadmin'] =		"Zahvaljujemo se na vašoj registraciji!  Vaš nalog mora biti aktiviran da bi ste igrali na našem serveru.";
$language['waitforadmin2'] = 	"Stići će vam e-mail kad vaš nalog bude aktiviran.";

// Admin interface messages
$language['passchangesuccess'] = "Vaša šifra je uspešno promenjena.  Molimo logujte se ponovo:";
$language['firsttime'] =		"Ovo je prvi put da ste koristili administratorski interfejs.  Molimo unesite vaš administratorski nalog i šifru:";

$language['acctswaiting'] =		"Nalog čeka aktivaciju:";
$language['noacctswaiting'] =	"Trenutno nema koristnika koji čekaju aktivaciju";

$language['admin_home'] =		"Početak";
$language['admin_logout'] =		"Odjavi se";
$language['admin_newacct2'] =	"Kreiraj nov korisnički nalog";
$language['admin_newacct'] =	"Kreiraj nov korisnički nalog:";
$language['runpurge'] =			"Pokreni purge.php";
// Example: 10 accounts purged
$language['purged'] = 			"Nalog purged";

// These are used in the table of users
$language['username'] =			"Korisnički nalog";
$language['email'] =			"Email";
$language['acctreg'] =			"Nalog registrovan";
$language['activate'] =			"Aktivirati";

// These are used in the signup form
$language['form_username'] =	"Korisnički nalog:";
$language['form_password'] =	"Šifra:";
$language['form_confpass'] =	"Potvrdite šifru:";
$language['form_email'] =		"Email adresa:";
$language['form_submit'] =		"Kreiraj novi nalog!";
// On the admin-only signup form...
$language['form_allchars'] =	"Zaobići Simbole za korisnicki nalog";

// Admin change password screen
$language['currpassword'] =		"Trenutna šifra:";
$language['newusername'] = 		"Novi nalog:";
$language['newpassword'] =		"Nova šifra:";
$language['confnewpass'] =		"Potvrdite novu šifru:";
$language['setpass'] =			"Postavite šifru";
$language['changepass'] =		"Promenite šifru";

////// Error messages //////
$language['error'] =			"Greska:";
$language['sqlerror'] =			"MySQL Greska:";
$language['sqlsaid'] =			"MySQL prikazuje:";

// Account creation error messages.
$language['userexists'] = 		"Nalog sa tim imenom već postoji.";
$language['passmismatch'] = 	"Šifra i šifra koja je ponovljena se ne poklapaju.";
$language['shortpass'] = 		"Vaša šifra mora imati minimum 3 karaktera.";
$language['bademail'] = 		"Vaša Email adresa je nevazeća.";
$language['noemail'] = 			"Morate uneti Email adresu.";
$language['oneemailonly'] = 	"Izvinite, samo jedan isti Email za nalog je dozvoljen.";

// Account activation error messages.
$language['invalidcode'] = 		"Aktivacioni kod je nepravlan. Ovaj nalog je moguće već aktiviran.";
$language['notwaiting'] =		"Korisnički nalog koji ste uneli ne čeka zahtev za aktivaciju.";

// Database error messages.
$language['dbconnecterror'] = 	"Ne mogu da se vezem za MySQL podataka.";
$language['dbinserterror'] = 	"Greška u unosu podataka u bazu.";
$language['dbdeleteerror'] = 	"Greška u brisanju bazi podataka.";
$language['dbreaderror'] = 		"Ne mogu da pročitam bazu.";

// Email error messages.
$language['emailsenderror'] = 	"Greška pri slanju Email-a.";

// Admin interface error messages.
$language['nosession'] = 		"Vaš administratorska sesija je istekla. Molimo logujte se ponovo:";
$language['badadminpass'] = 	"Greška u šifri";
$language['editadminprefs'] = 	"Ne mogu da otvorim admin_prefs.php za pisanje";

// Email subject lines
// For email activation: the activation email
$language['subject_activationemail'] = "Vaš novi PvPGN korisnički nalog";

// For admin activation: this is sent to the user after their account has been approved
$language['subject_activatedemail'] = "Vaš korisnički nalog je aktiviran";

// For admin activation: this email is sent to the admin when there is an account waiting
$language['subject_adminemail'] = "Molimo aktivirajte ovaj nalog za PvPGN server";

/************************************************************************
 *                  --- Special language constants ---                  *
 *  These have various bits of information substituted into them.       *
 *  Make sure you read the comments and be careful when editing these!  *
 ************************************************************************/

// These must have [[filename]] in the appropriate place.
$language['missingfile'] = 		"Potrebna datoteka, [[filename]], ne postoji.";
$language['fopenerror'] =		"[[filename]] postoji, ali ne može da se otvori.  Proverite permisije.";

// In the following, [[allowed_chars]] will be replaced by $account_allowed_chars as specified in config.php.
$language['invalidname'] = 		"Vaš korisnički nalog ima nevažeće karaktere. Samo slova, numerički brojevi i [[allowed_chars]] su dozvoljeni.";

// This must contain [[resend_url]], that being the link that a user would click on to have the activation email resent.
$language['resend'] = 			"Ako želite ponovo da pošaljemo aktivacioni mail, molimo kliknite <a href=\"[[resend_url]]\">ovde</a>.";

// This must contain [[acct_username]] and [[acct_email]]
$language['sent'] =				"[[acct_username]], Mi smo poslali aktivacioni email [[acct_email]]. Molimo sledite upustva kako bi ste aktivirali vas korisnički nalog.";

// This must contain [[acct_username]] and [[acct_email]]
$language['resent'] =			"[[acct_username]], Mi smo ponovo poslali aktivacioni email [[acct_email]]. Molimo sledite upustva kako bi ste aktivirali vas korisnički nalog.";

// This is used in the admin interface.  Must contain [[acct_username]]
$language['admincreated'] =		"Korisnički nalog \"[[acct_username]]\" je uspešno kreiran";

// This is used in the admin interface.  Must contain [[acct_username]]
$language['adminactivated'] =	"Korisnički nalog \"[[acct_username]]\" je aktiviran";

// This is used in the admin interface.  Must contain [[acct_username]]
$language['admindeleted'] =		"Korisnički nalog \"[[acct_username]]\" je obrisan";

// This must contain [[version]]
$language['footer'] =			"PvPGN Web Registration System [[version]] by <A HREF=\"mailto:mark@darkterrorsdomain.cjb.net\">U-238</A>";

?>
