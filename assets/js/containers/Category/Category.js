import React from 'react'
import { connect } from 'react-redux'
import Header from '../../components/Header/Header'
import Slider from '../../components/Slider/Slider'
import Tile from '../../components/Tile/Tile'
import InfoUrl from '../../components/InfoUrl/InfoUrl'
import Footer from '../../components/Footer/Footer'
import * as Sample from '../../Sample'

export class Category extends React.Component {
  constructor (props) {
    super(props)
    this.state = {
      news: Sample.newsCategory,
      categories: Sample.subCategoriesCategory,
      infoUrl: Sample.infoUrl
    }
  }
  render () {
    return (
      <div id={'category'}>
        <Header />
        <div className={'box'}>
          <Slider className={'slider'} items={this.state.news}>
            <div className={'content'}>
              {
                this.state.categories.map((tile, index) => (
                  <Tile key={index} item={tile} />
                ))
              }
              <div className={'search'}><input type={'text'} placeholder={'Rechercher'} /></div>
            </div>
          </Slider>
        </div>
        <div className={'stripes'}>
          {
            // this.state.categories.map((stripe, index) => (
            //   // <Stripe key={index} item={stripe} />
            // ))
          }
        </div>
        <InfoUrl url={this.state.infoUrl.url} text={this.state.infoUrl.text} />
        <Footer />
      </div>
    )
  }
}

require('./Category.scss')

export default connect()(Category)
