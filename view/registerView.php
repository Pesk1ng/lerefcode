 <?php $minDateOfBirth = date ('Y-m-d', strtotime("15 year ago")) ; $maxDateOfBirth = date ('Y-m-d', strtotime("150 year ago")) ;  //date('Y-MM-d', time("15 year past")) ; ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>LeRefcode </title><!--&mdash; Accueil-->
        <meta charset="utf-8">
        <link rel="icon" href="rdists/images/favicon.png" type="image/png">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="rdists/css/bootstrap-4.3.1.css">
        <link rel="stylesheet" href="css/jquery.fancybox.min.css">
        <link rel="stylesheet" href="css/bootstrap-select.min.css">
        <link rel="stylesheet" href="rdists/fonts/icomoon/style.css">
        <link rel="stylesheet" href="rdists/fonts/line-icons/style.css">
        <link rel="stylesheet" href="rdists/css/owl.carousel.min.css">
        <link rel="stylesheet" href="rdists/css/animate.min.css">
        <link rel="stylesheet" href="rdists/css/design.css">    
    </head>
    <body id="top" style="margin: 0.5%;">
        <div class="site-wrap">
            <div class="site-mobile-menu site-navbar-target">
                <div class="site-mobile-menu-header">
                    <div class="site-mobile-menu-close mt-3">
                        <span class="icon-close2 js-menu-toggle"></span>
                    </div>
                </div>
                <div class="site-mobile-menu-body"></div>
            </div> <!-- .site-mobile-menu -->
        </div>
        <section class="site-section overlay bg-image" id="next-section" style="padding: 0;">
            <div class="container-fluid">
                <div class="row">
                    <div id="register_left" class="col-lg-6 ml-auto rounded" style="background-image: url('rdists/images/banner/banner2.jpg'); background-size: cover; background-position: center; padding: 2% 5%;"> 
                        <div class="logo mb-3">
                            <a href="?">
                                <img src="rdists/images/brands/reflogo.png" alt="lerefcode" style="display:block; margin: 0 auto; max-width: 100%">
                            </a>
                        </div>
                        <div class="p-4 mb-3 bg-white rounded">
                            <p class="mb-0 font-weight-bold">INSCRIPTION</p>
                            <p class="mb-4">Votre parcours professionnel commence ici.</p>
                        </div>
                        <div class="left_image">
                            <img src="rdists/images/meet.png" style="max-width: 100%">
                        </div>
                    </div>
                    
                    <div class="col-lg-6 mb-5 mb-lg-0 bg-white" style="padding: 3.5% 5%;">
                        <!--
                        <div class="toast" role="alert" id="errorInputForm" aria-live="assertive" aria-atomic="true" data-autohide="false">
                            <div class="toast-header">                            
                                <strong class="mr-auto">Erreur</strong>
                                <small></small>
                                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="toast-body bg-warning">
                                Hello, world! This is a toast message.
                            </div>
                        </div> -->                    
                        <div class="alert alert-danger alert-dismissible fade show d-none font-weight-light text-uppercase" style="width: 40%; position: fixed !important ;
	                    right : 5px ; top : 0px ; z-index : 5 ; background-color : #096A09 ; color : ghostwhite; padding-bottom: 0px;" id="errorInputForm" role="alert">
                            <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>                    
                            <button type="button" id="alertErrorCloseButton" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="#" method="post" class="" id="registerFormFirst">
                    
                            <div class="row form-group">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="text-black" for="lastName">Nom</label>
                                    <input type="text" name="lastName" id="lastName" class="form-control" required maxlength="200">
                                </div>
                                <div class="col-md-6">
                                    <label class="text-black" for="firstName">Prénoms</label>
                                    <input type="text" name="firstName" id="firstName" class="form-control" required maxlength="200">
                                </div>
                            </div>
                    
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class="text-black" for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" required maxlength="200">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="text-black" for="dateOfBirth">Date de Naissance</label>
                                    <input type="date" name="dateOfBirth" id="dateOfBirth" class="form-control" min="<?= $maxDateOfBirth ?>" max="<?= $minDateOfBirth ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="text-black" for="nationality">Nationalité</label>
                                    <select name="nationality" class="form-control" id="nationality" required >
                                        <optgroup label="Afrique 54pays">                  
                                            <option value="Afrique du Sud">Afrique du Sud</option>
                                            <option value="Algérie">Algérie</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Bénin" selected>Bénin</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Burkina">Burkina</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cameroun">Cameroun</option>
                                            <option value="Cap-Vert">Cap-Vert</option>
                                            <option value="République centrafricaine">République centrafricaine</option>
                                            <option value="Comores">Comores</option>
                                            <option value="Congo">Congo</option>
                                            <option value="République démocratique du Congo">République démocratique du Congo</option>
                                            <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Égypte">Égypte</option>
                                            <option value="Érythrée">Érythrée</option>
                                            <option value="Éthiopie">Éthiopie</option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambie">Gambie</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Guinée">Guinée</option>
                                            <option value="Guinée-Bissau">Guinée-Bissau</option>
                                            <option value="Guinée équatoriale">Guinée équatoriale</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Libéria">Libéria</option>
                                            <option value="Libye">Libye</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Maroc">Maroc</option>
                                            <option value="Maurice">Maurice</option>
                                            <option value="Mauritanie">Mauritanie</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Namibie">Namibie</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Ouganda">Ouganda</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Sao Tomé-et-Principe">Sao Tomé-et-Principe</option>
                                            <option value="Sénégal">Sénégal</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Somalie">Somalie</option>
                                            <option value="Soudan">Soudan</option>
                                            <option value="Sud-Soudan">Sud-Soudan</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Tanzanie">Tanzanie</option>
                                            <option value="Tchad">Tchad</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tunisie">Tunisie</option>
                                            <option value="Zambie">Zambie</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </optgroup>
                                        <optgroup label="Amérique 36pays">
                                            <option value="Antigua-et-Barbuda">Antigua-et-Barbuda</option>
                                            <option value="Argentine">Argentine</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Barbade">Barbade</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Bolivie">Bolivie</option>
                                            <option value="Brésil">Brésil</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Chili">Chili</option>
                                            <option value="Colombie">Colombie</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="République dominicaine">République dominicaine</option>
                                            <option value="Dominique">Dominique</option>
                                            <option value="Équateur">Équateur</option>
                                            <option value="États-Unis">États-Unis</option>
                                            <option value="Grenade">Grenade</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haïti">Haïti</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Jamaïque">Jamaïque</option>
                                            <option value="Mexique">Mexique</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Pérou">Pérou</option>
                                            <option value="Porto Rico">Porto Rico</option>
                                            <option value="Saint-Christophe-et-Niévès">Saint-Christophe-et-Niévès</option>
                                            <option value="Sainte-Lucie">Sainte-Lucie</option>
                                            <option value="Saint-Vincent-et-les Grenadines">Saint-Vincent-et-les Grenadines</option>
                                            <option value="Salvador">Salvador</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Trinité-et-Tobago">Trinité-et-Tobago</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="Venezuela">Venezuela</option>
                                        </optgroup>
                                        <optgroup label="Asie 45pays">
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Arabie saoudite">Arabie saoudite</option>
                                            <option value="Bahreïn">Bahreïn</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Bhoutan">Bhoutan</option>
                                            <option value="Birmanie">Birmanie</option>
                                            <option value="Brunei">Brunei</option>
                                            <option value="Cambodge">Cambodge</option>
                                            <option value="Chine">Chine</option>
                                            <option value="Corée du Nord">Corée du Nord</option>
                                            <option value="Corée du Sud">Corée du Sud</option>
                                            <option value="Émirats arabes unis">Émirats arabes unis</option>
                                            <option value="Inde">Inde</option>
                                            <option value="Indonésie">Indonésie</option>
                                            <option value="Irak">Irak</option>
                                            <option value="Iran">Iran</option>
                                            <option value="Israël">Israël</option>
                                            <option value="Japon">Japon</option>
                                            <option value="Jordanie">Jordanie</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kirghizistan">Kirghizistan</option>
                                            <option value="Koweït">Koweït</option>
                                            <option value="Laos">Laos</option>
                                            <option value="Liban">Liban</option>
                                            <option value="Malaisie">Malaisie</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mongolie">Mongolie</option>
                                            <option value="Népal">Népal</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Ouzbékistan">Ouzbékistan</option>
                                            <option value="Palestine">Palestine</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Singapour">Singapour</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Syrie">Syrie</option>
                                            <option value="Tadjikistan">Tadjikistan</option>
                                            <option value="Taïwan">Taïwan</option>
                                            <option value="Thaïlande">Thaïlande</option>
                                            <option value="Timor oriental">Timor oriental</option>
                                            <option value="Turkménistan">Turkménistan</option>
                                            <option value="Turquie">Turquie</option>
                                            <option value="Viêt Nam">Viêt Nam</option>
                                            <option value="Yémen">Yémen</option>
                                        </optgroup>                  
                                        <optgroup label="Europe 48pays">
                                            <option value="Allemagne">Allemagne</option>
                                            <option value="Albanie">Albanie</option>
                                            <option value="Andorre">Andorre</option>
                                            <option value="Arménie">Arménie</option>
                                            <option value="Autriche">Autriche</option>
                                            <option value="Azerbaïdjan">Azerbaïdjan</option>
                                            <option value="Belgique">Belgique</option>
                                            <option value="Biélorussie">Biélorussie</option>
                                            <option value="Bosnie-Herzégovine">Bosnie-Herzégovine</option>
                                            <option value="Bulgarie">Bulgarie</option>
                                            <option value="Chypre">Chypre</option>
                                            <option value="Croatie">Croatie</option>
                                            <option value="Danemark">Danemark</option>
                                            <option value="Espagne">Espagne</option>
                                            <option value="Estonie">Estonie</option>
                                            <option value="Finlande">Finlande</option>
                                            <option value="France">France</option>
                                            <option value="Géorgie">Géorgie</option>
                                            <option value="Grèce">Grèce</option>
                                            <option value="Hongrie">Hongrie</option>
                                            <option value="Irlande">Irlande</option>
                                            <option value="Islande">Islande</option>
                                            <option value="Italie">Italie</option>
                                            <option value="Lettonie">Lettonie</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lituanie">Lituanie</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="République de Macédoine">République de Macédoine</option>
                                            <option value="Malte">Malte</option>
                                            <option value="Moldavie">Moldavie</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Monténégro">Monténégro</option>
                                            <option value="Norvège">Norvège</option>
                                            <option value="Pays-Bas">Pays-Bas</option>
                                            <option value="Pologne">Pologne</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="République tchèque">République tchèque</option>
                                            <option value="Roumanie">Roumanie</option>
                                            <option value="Royaume-Uni">Royaume-Uni</option>
                                            <option value="Russie">Russie</option>
                                            <option value="Saint-Marin">Saint-Marin</option>
                                            <option value="Serbie">Serbie</option>
                                            <option value="Slovaquie">Slovaquie</option>
                                            <option value="Slovénie">Slovénie</option>
                                            <option value="Suède">Suède</option>
                                            <option value="Suisse">Suisse</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="Vatican">Vatican</option>
                                        </optgroup>
                                        <optgroup label="Océannie 14pays">
                                            <option value="Australie">Australie</option>
                                            <option value="Fidji">Fidji</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Marshall">Marshall</option>
                                            <option value="Micronésie">Micronésie</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nouvelle-Zélande">Nouvelle-Zélande</option>
                                            <option value="Palaos">Palaos</option>
                                            <option value="Papouasie-Nouvelle-Guinée">Papouasie-Nouvelle-Guinée</option>
                                            <option value="Salomon">Salomon</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                        </optgroup>
                                    </select> 
                                    <?php //<input type="text" name="nationality" id="nationality" class="form-control" required maxlength="200"> ?>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="text-black" for="countryOfResidence">Pays de Résidence</label>
                                    <select name="countryOfResidence" class="form-control" id="countryOfResidence" required >
                                        <optgroup label="Afrique 54pays">                  
                                            <option value="Afrique du Sud">Afrique du Sud</option>
                                            <option value="Algérie">Algérie</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Bénin" selected>Bénin</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Burkina">Burkina</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cameroun">Cameroun</option>
                                            <option value="Cap-Vert">Cap-Vert</option>
                                            <option value="République centrafricaine">République centrafricaine</option>
                                            <option value="Comores">Comores</option>
                                            <option value="Congo">Congo</option>
                                            <option value="République démocratique du Congo">République démocratique du Congo</option>
                                            <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Égypte">Égypte</option>
                                            <option value="Érythrée">Érythrée</option>
                                            <option value="Éthiopie">Éthiopie</option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambie">Gambie</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Guinée">Guinée</option>
                                            <option value="Guinée-Bissau">Guinée-Bissau</option>
                                            <option value="Guinée équatoriale">Guinée équatoriale</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Libéria">Libéria</option>
                                            <option value="Libye">Libye</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Maroc">Maroc</option>
                                            <option value="Maurice">Maurice</option>
                                            <option value="Mauritanie">Mauritanie</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Namibie">Namibie</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Ouganda">Ouganda</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Sao Tomé-et-Principe">Sao Tomé-et-Principe</option>
                                            <option value="Sénégal">Sénégal</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Somalie">Somalie</option>
                                            <option value="Soudan">Soudan</option>
                                            <option value="Sud-Soudan">Sud-Soudan</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Tanzanie">Tanzanie</option>
                                            <option value="Tchad">Tchad</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tunisie">Tunisie</option>
                                            <option value="Zambie">Zambie</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </optgroup>
                                        <optgroup label="Amérique 36pays">
                                            <option value="Antigua-et-Barbuda">Antigua-et-Barbuda</option>
                                            <option value="Argentine">Argentine</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Barbade">Barbade</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Bolivie">Bolivie</option>
                                            <option value="Brésil">Brésil</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Chili">Chili</option>
                                            <option value="Colombie">Colombie</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="République dominicaine">République dominicaine</option>
                                            <option value="Dominique">Dominique</option>
                                            <option value="Équateur">Équateur</option>
                                            <option value="États-Unis">États-Unis</option>
                                            <option value="Grenade">Grenade</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haïti">Haïti</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Jamaïque">Jamaïque</option>
                                            <option value="Mexique">Mexique</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Pérou">Pérou</option>
                                            <option value="Porto Rico">Porto Rico</option>
                                            <option value="Saint-Christophe-et-Niévès">Saint-Christophe-et-Niévès</option>
                                            <option value="Sainte-Lucie">Sainte-Lucie</option>
                                            <option value="Saint-Vincent-et-les Grenadines">Saint-Vincent-et-les Grenadines</option>
                                            <option value="Salvador">Salvador</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Trinité-et-Tobago">Trinité-et-Tobago</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="Venezuela">Venezuela</option>
                                        </optgroup>
                                        <optgroup label="Asie 45pays">
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Arabie saoudite">Arabie saoudite</option>
                                            <option value="Bahreïn">Bahreïn</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Bhoutan">Bhoutan</option>
                                            <option value="Birmanie">Birmanie</option>
                                            <option value="Brunei">Brunei</option>
                                            <option value="Cambodge">Cambodge</option>
                                            <option value="Chine">Chine</option>
                                            <option value="Corée du Nord">Corée du Nord</option>
                                            <option value="Corée du Sud">Corée du Sud</option>
                                            <option value="Émirats arabes unis">Émirats arabes unis</option>
                                            <option value="Inde">Inde</option>
                                            <option value="Indonésie">Indonésie</option>
                                            <option value="Irak">Irak</option>
                                            <option value="Iran">Iran</option>
                                            <option value="Israël">Israël</option>
                                            <option value="Japon">Japon</option>
                                            <option value="Jordanie">Jordanie</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kirghizistan">Kirghizistan</option>
                                            <option value="Koweït">Koweït</option>
                                            <option value="Laos">Laos</option>
                                            <option value="Liban">Liban</option>
                                            <option value="Malaisie">Malaisie</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mongolie">Mongolie</option>
                                            <option value="Népal">Népal</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Ouzbékistan">Ouzbékistan</option>
                                            <option value="Palestine">Palestine</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Singapour">Singapour</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Syrie">Syrie</option>
                                            <option value="Tadjikistan">Tadjikistan</option>
                                            <option value="Taïwan">Taïwan</option>
                                            <option value="Thaïlande">Thaïlande</option>
                                            <option value="Timor oriental">Timor oriental</option>
                                            <option value="Turkménistan">Turkménistan</option>
                                            <option value="Turquie">Turquie</option>
                                            <option value="Viêt Nam">Viêt Nam</option>
                                            <option value="Yémen">Yémen</option>
                                        </optgroup>                  
                                        <optgroup label="Europe 48pays">
                                            <option value="Allemagne">Allemagne</option>
                                            <option value="Albanie">Albanie</option>
                                            <option value="Andorre">Andorre</option>
                                            <option value="Arménie">Arménie</option>
                                            <option value="Autriche">Autriche</option>
                                            <option value="Azerbaïdjan">Azerbaïdjan</option>
                                            <option value="Belgique">Belgique</option>
                                            <option value="Biélorussie">Biélorussie</option>
                                            <option value="Bosnie-Herzégovine">Bosnie-Herzégovine</option>
                                            <option value="Bulgarie">Bulgarie</option>
                                            <option value="Chypre">Chypre</option>
                                            <option value="Croatie">Croatie</option>
                                            <option value="Danemark">Danemark</option>
                                            <option value="Espagne">Espagne</option>
                                            <option value="Estonie">Estonie</option>
                                            <option value="Finlande">Finlande</option>
                                            <option value="France">France</option>
                                            <option value="Géorgie">Géorgie</option>
                                            <option value="Grèce">Grèce</option>
                                            <option value="Hongrie">Hongrie</option>
                                            <option value="Irlande">Irlande</option>
                                            <option value="Islande">Islande</option>
                                            <option value="Italie">Italie</option>
                                            <option value="Lettonie">Lettonie</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lituanie">Lituanie</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="République de Macédoine">République de Macédoine</option>
                                            <option value="Malte">Malte</option>
                                            <option value="Moldavie">Moldavie</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Monténégro">Monténégro</option>
                                            <option value="Norvège">Norvège</option>
                                            <option value="Pays-Bas">Pays-Bas</option>
                                            <option value="Pologne">Pologne</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="République tchèque">République tchèque</option>
                                            <option value="Roumanie">Roumanie</option>
                                            <option value="Royaume-Uni">Royaume-Uni</option>
                                            <option value="Russie">Russie</option>
                                            <option value="Saint-Marin">Saint-Marin</option>
                                            <option value="Serbie">Serbie</option>
                                            <option value="Slovaquie">Slovaquie</option>
                                            <option value="Slovénie">Slovénie</option>
                                            <option value="Suède">Suède</option>
                                            <option value="Suisse">Suisse</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="Vatican">Vatican</option>
                                        </optgroup>
                                        <optgroup label="Océannie 14pays">
                                            <option value="Australie">Australie</option>
                                            <option value="Fidji">Fidji</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Marshall">Marshall</option>
                                            <option value="Micronésie">Micronésie</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nouvelle-Zélande">Nouvelle-Zélande</option>
                                            <option value="Palaos">Palaos</option>
                                            <option value="Papouasie-Nouvelle-Guinée">Papouasie-Nouvelle-Guinée</option>
                                            <option value="Salomon">Salomon</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                        </optgroup>
                                    </select> 
                                    <?php //<input type="text" name="countryOfResidence" id="countryOfResidence" class="form-control" required> ?>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-black" for="cityOfResidence">Ville de Résidence</label>
                                    <input type="text" name="cityOfResidence" id="cityOfResidence" class="form-control" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class="text-black" for="gender">Vous êtes</label>
                                    <select class="form-control" name="gender" id="gender" required>
                                        <option value="1">Homme</option>
                                        <option value="0">Femme</option>
                                    </select>
                                </div>
                            </div>
                    
                            <div class="row form-group mt-5">
                                <div class="col-md-12">
                                    <input type="submit" id="formRegisterFirstSubmit" value="Etape Suivante" class="btn btn-primary btn-md text-white" required>
                                </div>
                            </div>
                        </form>
                        <form action="#" method="post" class="d-none" id="registerFormSecond" enctype="multipart/form-data" >
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class="text-black" for="photoOfProfil">Importez une photo de vous</label>
                                    <input type="file" name="photoOfProfil" id="photoOfProfil" class="form-control" required accept=".png, .gif, .jpg, .jpeg" >
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class="text-black" for="aboutCompetence">Parlez en bref de vos compétences</label>
                                    <textarea name="aboutCompetence" id="aboutCompetence"  minlength="300" maxlength="1000"  cols="30" rows="7" class="form-control"
                                placeholder="Écrivez en 300 caractères minimum vos compétences ..."></textarea>
                                </div>
                            </div>


                            <div class="row form-group">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="text-black" for="password">Créez votre mot de passe</label>
                                    <input type="password" name="password" id="password" class="form-control" required minlength="8" maxlength="20">
                                </div>

                                <div class="col-md-6">
                                    <label class="text-black" for="samePassword">Confirmez le mot de passe</label>
                                    <input type="password" name="samePassword" id="samePassword" class="form-control" required minlength="8" maxlength="20">
                                </div>
                            </div>

                            <div class="row form-group mt-5">
                                <div class="col-md-6">
                                    <button  class="btn btn-primary btn-md text-white" id="previousButton">Revenir en arrière</button>
                                </div>
                                <div class="col-md-6">
                                    <input type="submit" value="Valider Mon Inscription" class="btn btn-primary btn-md text-white" required >
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>

        <!-- SCRIPTS -->
	<script src="rdists/js/jquery.js"></script>
    <!--<script src="rdists/js/jquery.min.js"></script> -->
    <script src="rdists/js/bootstrap.bundle.min.js"></script>
    <script src="rdists/js/isotope.pkgd.min.js"></script>
    
    <script src="rdists/js/jquery.waypoints.min.js"></script>
    <script src="rdists/js/jquery.animateNumber.min.js"></script>
    <script src="rdists/js/owl.carousel.min.js"></script>
   
    
    <script src="rdists/js/main.js"></script>
    <script type="text/javascript" src="view/js/registerView.js"></script>
    </body>
