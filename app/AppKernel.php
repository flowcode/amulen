<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel {

    public function init() {

        date_default_timezone_set('America/Buenos_Aires');

        parent::init();
    }

    public function registerBundles() {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            /* miweb */
            new Flowcode\ClassificationBundle\FlowcodeClassificationBundle(),
            new Flowcode\NewsBundle\FlowcodeNewsBundle(),
            new Flowcode\PageBundle\FlowcodePageBundle(),
            new Flowcode\MediaBundle\FlowcodeMediaBundle(),
            new Flowcode\ShopBundle\FlowcodeShopBundle(),
            new Flowcode\UserBundle\FlowcodeUserBundle(),
            new Flowcode\ProjectBundle\FlowcodeProjectBundle(),
            new Flowcode\DashboardBundle\FlowcodeDashboardBundle(),
            new Flowcode\DemoBundle\FlowcodeDemoBundle(),
            /* libs */
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Braincrafted\Bundle\BootstrapBundle\BraincraftedBootstrapBundle(),
            new Sonata\SeoBundle\SonataSeoBundle(),
            new Symfony\Cmf\Bundle\SeoBundle\CmfSeoBundle(),
            new Lunetics\LocaleBundle\LuneticsLocaleBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
            new FM\ElfinderBundle\FMElfinderBundle(),
            new Liip\ImagineBundle\LiipImagineBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader) {
        $loader->load(__DIR__ . '/config/config_' . $this->getEnvironment() . '.yml');
    }

}
