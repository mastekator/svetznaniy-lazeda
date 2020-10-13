<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

?>

<?php wc_print_notices(); ?>

<?php do_action('woocommerce_before_customer_login_form'); ?>

<?php if (get_option('woocommerce_enable_myaccount_registration') === 'yes') : ?>

<div class="u-columns col2-set" id="customer_login">

    <div class="u-column1 col-1">

        <?php endif; ?>

        <h2><?php pll_e('Login'); ?></h2>

        <p class="description"><?php pll_e('Great to have you back!') ?></p>

        <div class="row">
            <div class="col-lg-6 col-12 offset-lg-3 offset-0">
                <form class="woocommerce-form woocommerce-form-login login" method="post">

                    <?php do_action('woocommerce_login_form_start'); ?>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username"
                               id="username" placeholder="<?php pll_e('Username or email address') ?>"
                               value="<?php echo (!empty($_POST['username'])) ? esc_attr($_POST['username']) : ''; ?>"/>
                    </p>
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <input class="woocommerce-Input woocommerce-Input--text input-text" type="password"
                               name="password"
                               id="password" placeholder="<?php pll_e('Password') ?>"/>
                    </p>

                    <?php do_action('woocommerce_login_form'); ?>

                    <p class="form-row">
                        <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                        <button type="submit" class="woocommerce-Button button" name="login"
                                value="<?php esc_attr_e('Login', 'lezada'); ?>"><?php pll_e('Login'); ?></button>
                        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
                            <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme"
                                   type="checkbox" id="rememberme" value="forever"/>
                            <span><?php pll_e('Remember me'); ?></span>
                        </label>
                    </p>
                    <p class="woocommerce-LostPassword lost_password">
                        <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php pll_e('Lost your password?'); ?></a>
                    </p>

                    <?php do_action('woocommerce_login_form_end'); ?>

                </form>
            </div>
        </div>

        <?php if (get_option('woocommerce_enable_myaccount_registration') === 'yes') : ?>

    </div>

    <div class="u-column2 col-2">

        <h2><?php pll_e('Register'); ?></h2>

        <p class="description"><?php pll_e('If you don’t have an account, register now!'); ?></p>

        <div class="col-lg-6 col-12 offset-lg-3 offset-0">
            <form method="post" class="register">

                <?php do_action('woocommerce_register_form_start'); ?>

                <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_username"><?php pll_e('Username'); ?> <span class="required">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username"
                               id="reg_username"
                               value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
                    </p>

                <?php endif; ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="reg_email"><?php pll_e('Email address'); ?> <span
                                class="required">*</span></label>
                    <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email"
                           id="reg_email"
                           value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
                </p>

                <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_password"><?php pll_e('Password'); ?> <span class="required">*</span></label>
                        <input type="password" class="woocommerce-Input woocommerce-Input--text input-text"
                               name="password"
                               id="reg_password"/>
                    </p>

                <?php endif; ?>

                <?php do_action('woocommerce_register_form'); ?>

                <p class="woocommerce-FormRow form-row button-register">
                    <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                    <button type="submit" class="woocommerce-Button button" name="register"
                            value="<?php esc_attr_e('Register', 'lezada'); ?>"><?php pll_e('Register'); ?></button>
                </p>

                <?php do_action('woocommerce_register_form_end'); ?>

            </form>
        </div>
    </div>

</div>
<?php endif; ?>

<?php do_action('woocommerce_after_customer_login_form'); ?>
