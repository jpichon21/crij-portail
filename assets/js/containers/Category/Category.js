import React from 'react'
import { connect } from 'react-redux'
import Header from '../../components/Header/Header'
import Slider from '../../components/Slider/Slider'
import Tile from '../../components/Tile/Tile'
import Stripe from '../../components/Stripe/Stripe'
import InfoUrl from '../../components/InfoUrl/InfoUrl'
import Footer from '../../components/Footer/Footer'
import * as Sample from '../../Sample'

export class Category extends React.Component {
  constructor (props) {
    super(props)
    this.state = {
      news: Sample.news,
      sections: Sample.sections,
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
                this.state.sections.map((tile, index) => (
                  <Tile key={index} item={tile} />
                ))
              }
              <div className={'search'}><input type={'text'} placeholder={'Rechercher'} /></div>
            </div>
          </Slider>
        </div>
        <div className={'stripes'}>
          {
            this.state.sections.map((stripe, index) => (
              <Stripe key={index} item={stripe} />
            ))
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
