<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.cecredentialtrust.com
 * @since      1.0.0
 *
 * @package    CeValidationsr
 * @subpackage CeValidationsr/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Credential Validation</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Share+Tech+Mono" type="text/css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css"/>
        <link rel="stylesheet" href="css/client.css" type="text/css"/>
    </head>
    <body>

        <div class="container">

            <div class="row padbot20">
                <div class='col-md-12'>
                    <div>
                        <h1>Credential Validation</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="form-horizontal">
                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <div class="col-md-6 labelgray">
                                        <label><b>Please enter CeDiD</b><br />(not case sensitive)</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="CeDiDNumber text-box single-line" data-masked-input="wwww-wwww-wwww" data-val="true" data-val-regex="____-____-____ format required." data-val-regex-pattern="(([a-zA-Z0-9]{4})[-]([a-zA-Z0-9]{4})[-]([a-zA-Z0-9]{4}))" data-val-required="The CeDiD field is required." id="CeDiD" maxlength="14" name="CeDiD" placeholder="____-____-____" type="text" value="" style="width:246px; min-width:246px;" />
                                        <div class="AlphaNumericKey">
                                            <img id="SUCeDiDNumbers" src=https://cedimages.blob.core.windows.net/publicimages/Content/Images/CeDiplomaImages/AlphaNumericKey_221x22.png alt="Alphanumeric Key" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 labelgray">
                                        <label><b>Enter the first two letters of the name as it appears on the credential</b></label>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="CeDiDNumber text-box single-line" data-masked-input="99" data-val="true" data-val-length="Must be 2 characters." data-val-length-max="2" data-val-length-min="2" data-val-required="The UserName field is required." id="UserFirstTwoLetters" maxlength="2" name="UserFirstTwoLetters" placeholder="__" style="width:3em;" type="text" value="" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6">
                                        <input type="button" id="Validate" value="Validate" onclick="queryEndpoint();" class="btn btn-success" title="Validate CeDiploma" />

                                    </div>
                                </div>

                                <div class="form-group padtop0">
                                    <div class="col-md-12">
                                        <a href="https://secure.cecredentialtrust.com" target="_blank"><img id="SULogoimg1" height="50" src=https://cedimages.blob.core.windows.net/publicimages/Content/Images/CeDiplomaImages/poweredbyCeCredentialTrustLogo_180x34.png alt="Powered by CeCredential TRUST" /></a>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <hr id="hrgray" class="hr-gray" />
                            <h4>Apostille:</h4>
                            <p class="text-justify">
                            An Apostille may neither be required nor necessary. The CeDiploma has legal standing, is non-repudiating, and can be validated through the University&rsquo;s website to provide absolute confidence in the credential&rsquo;s authenticity. Questions should be redirected to <a href="mailto:<?php echo get_option('cevalidation_apostilleemail'); ?>?subject=Apostille Information Request" data-rel="external" target="_blank"><?php echo get_option('cevalidation_apostilleemail'); ?></a>.
                            </p>
                        </div>
                    </div>

                    <div class="row padtop24">
                        <div class="col-md-6">
                            <hr class="hr-gray" />
                            <p id="logoCHEA">
                            <a href="https://www.chea.org/search-institutions" target="_blank"><img id="CheaImageId"
                                src="https://cedimages.blob.core.windows.net/publicimages/Content/Images/CeDiplomaImages/Logo_CHEA_100x36.png"
                                alt="CHEA Logo" alt="Powered by CeCredential TRUST" /></a>
                            </p>
                            <p id="pCHEA">
                            You may check institutional accreditation through the Council for Higher Education Accreditation
                            (CHEA):<br />
                            <span>
                                <i>(CHEA is an independent, non-profit organization, and neither endorses, authorizes, sponsors, nor is
                                affiliated with CeCredential Trust.)</i> <a href="https://www.chea.org/search-institutions"
                                data-rel="external" target="_blank">https://www.chea.org/search-institutions</a>.</span>
                            </p>
                        </div>
                    </div>

                    <div class="row padtop0">
                        <div class="col-md-6">
                            <p id='successfail_result'></p>
                            <table id="result_table" class="table table-bordered table-striped" style="border:1px solid blue;"></table>
                        </div>
                    </div>

                    <div class="row padtop0">
                        <div class="col-md-6">
                            <p id='crecredential_info'>
                                For more information, please visit <a href="https://secure.cecredentialtrust.com/cecredential/overview/" target="_blank">CeCredential Trust</a>.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js" integrity="sha256-DI6NdAhhFRnO2k51mumYeDShet3I8AKCQf/tf7ARNhI=" crossorigin="anonymous"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery.maskedinput.min.js"></script>
        <script type="text/javascript" src="js/client.js"></script>

    </body>
</html>
