<?php
/**
 * Provide a public-facing view for the How to Apply plugin option
 *
 * @link 		http://paradigm-corp.com
 * @since 		1.0.0
 *
 * @package 	CeValidationsr
 * @subpackage 	cevalidationsr/public/partials
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
?>

<!-- Include if you don't have a header on your page: -->
<!-- <div class="row padbot20">
		<div class='col-md-12'>
			<div>
				<h1>Credential Validation</h1>
			</div>
		</div>
	</div> -->

<div class="row">
  <div class="col-md-12">

    <div class="form-horizontal">

      <div class="col-md-6">

        <div class="form-group">
          <div class="col-md-6 labelgray">
            <label><b>Please enter CeDiD</b><br />(not case sensitive)</label>
          </div>
          <div class="col-md-5">
            <input class="CeDiDNumber text-box single-line" data-masked-input="wwww-wwww-wwww" data-val="true"
              data-val-regex="____-____-____ format required."
              data-val-regex-pattern="(([a-zA-Z0-9]{4})[-]([a-zA-Z0-9]{4})[-]([a-zA-Z0-9]{4}))"
              data-val-required="The CeDiD field is required." id="CeDiD" maxlength="14" name="CeDiD"
              placeholder="____-____-____" type="text" value="" style="width:246px; min-width:246px;" />
            <div class="AlphaNumericKey">
              <img id="SUCeDiDNumbers"
                src=https://cedimages.blob.core.windows.net/publicimages/Content/Images/CeDiplomaImages/AlphaNumericKey_221x22.png
                alt="Alphanumeric Key" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <input type="button" id="Validate" value="Validate" class="cevalidate btn btn-success"
            title="Validate Credential" />
        </div>

        <div class="form-group padtop0">
          <div class="col-md-12">
            <a href="https://secure.cecredentialtrust.com" target="_blank"><img id="SULogoimg1" height="50"
                src=https://cedimages.blob.core.windows.net/publicimages/Content/Images/CeDiplomaImages/poweredbyCeCredentialTrustLogo_180x34.png
                alt="Powered by CeCredential TRUST"></a>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <p id="successfail_result"></p>
        <table id="result_table" class="table table-bordered table-striped"></table>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div id="scholarrecord_result"></div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <!-- <hr class="hr-gray" /> -->
        <h4>Apostille:</h4>
        <p class="text-justify">
          An Apostille may neither be required nor necessary. The CeDiploma has legal standing, is non-repudiating,
          and can be validated through the University&rsquo;s website to provide absolute confidence in the
          credential&rsquo;s authenticity. Questions should be redirected to
          <a href="mailto:<?php echo get_option('cevalidationsr_apostilleemail'); ?>?subject=Apostille Information Request" data-rel="external" target="_blank"><?php echo get_option('cevalidationsr_apostilleemail'); ?></a>.
        </p>
      </div>
    </div>

    <?php
      if (get_option('cevalidationsr_displaychealogo')[0] == 'yes') {
        echo '<div class="row padtop24"><div class="col-md-8"><p id="logoCHEA"><a href="https://www.chea.org/search-institutions" data-rel="external" target="_blank" rel="noopener noreferrer" aria-label="CHEA.org Search Institution (in tab)"><img id="CheaImageId" src="https://cedimages.blob.core.windows.net/publicimages/Content/Images/CeDiplomaImages/Logo_CHEA_100x36.png" alt="CHEA Logo"></a></p><p id="pCHEA">You may check institutional accreditation through the Council for Higher Education Accreditation (CHEA):<br><span><i>(CHEA is an independent, non-profit organization, and neither endorses, authorizes, sponsors, nor is affiliated with CeCredential Trust.)</i> <a href="https://www.chea.org/search-institutions" data-rel="external" target="_blank" rel="noopener noreferrer" aria-label="CHEA.org Search Institutions (in tab)">https://www.chea.org/search-institutions</a>.</span></p></div></div>';
      }
    ?>

    <div class="row padtop0">
      <div class="col-md-6">
        <p id="crecredential_info">
          For more information, please visit <a href="https://secure.cecredentialtrust.com/cecredential/overview/"
            target="_blank">CeCredential Trust</a>.
        </p>
      </div>
    </div>

  </div>
</div>