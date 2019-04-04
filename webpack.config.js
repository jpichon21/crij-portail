var Encore = require('@symfony/webpack-encore')

Encore
  .setOutputPath('web/build/')
  .setPublicPath('/build')

  .addEntry('app', './assets/js/index.js')
  .enableReactPreset()

  .enableSingleRuntimeChunk()

  .cleanupOutputBeforeBuild()
  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction())

  .enableSassLoader()

  .copyFiles({
    from: './assets/img',
    to: 'img/[path][name].[ext]'
  })

module.exports = Encore.getWebpackConfig()
