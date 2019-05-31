<section class="global-search">
    <?php echo form_tag('zoeken/snelzoeken'); ?>
        <div class="global-search__select-container">
            <?php
            /** @var array<string, string> $selectOptions */
            echo select_tag('snelzoeken_type', options_for_select($selectOptions));
            ?>
        </div>
        <div class="global-search__input-container">
            <?php echo input_tag('snelzoeken_veld', $sf_params->get("snelzoeken_veld"), ['placeholder' => __('Zoeken')]); ?>
        </div>
        <div class="global-search__submit-container">
            <button type="submit"><i class="fas fa-search"></i></button>
        </div>
    </form>
</section>