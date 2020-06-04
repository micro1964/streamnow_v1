<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(MobileRegisterSeeder::class);
        $this->call(AdminDemoLoginSeeder::class);
        $this->call(SettingsAngularURLAndEmailVerify::class);
        $this->call(EmailNotificationControlSeeder::class);
        $this->call(UrlSeeder::class);
        $this->call(CommissionSpilitSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AddedScriptsKeyInSettingsTable::class);
        $this->call(AddedCoverImagesInSettings::class);
        $this->call(AddedSocketKeyInSettings::class);
        $this->call(AddedServerUrlInSettings::class);
        $this->call(AddedCommonUrlInSettings::class);
        $this->call(AddedRTMPKeyInsettings::class);
        $this->call(ChatUrlSettings::class);
        $this->call(DeleteVideoHourSettings::class);
        $this->call(WowzaIpAddress::class);
        $this->call(AddSocialLinksSeeder::class);
        $this->call(RedeemSeeder::class);
        $this->call(TokenExpiryhour::class);
        $this->call(JWplayerKeySeeder::class);
        $this->call(MailGunSeeder::class);
        $this->call(AppLinkSeeder::class);
        $this->call(IosPaymentStatusSeeder::class);
        $this->call(AddedStripeKeyInSettings::class);
        $this->call(PageCountSeeder::class);
        $this->call(VodStreamingSeeder::class);
        $this->call(SEOSeeder::class);
        $this->call(LiveVideoDeleteSeeder::class);
        $this->call(VodCommissionSplitSeeder::class);
        $this->call(WowzaDetailsSeeder::class);
        $this->call(WowzaExistsSeeder::class);
        $this->call(NotificationSeeder::class);
        $this->call(LiveurlSeeder::class);
        $this->call(V4_1_Seeder::class);
        $this->call(WowzaIsSSLSeeder::class);
        $this->call(FcmSettingsSeeder::class);
    }
}
