import React from 'react'
import { connect } from 'react-redux'
import Header from '../../components/Header/Header'
import Slider from '../../components/Slider/Slider'
import Tile from '../../components/Tile/Tile'
import InfoUrl from '../../components/InfoUrl/InfoUrl'
import Footer from '../../components/Footer/Footer'
import * as Sample from '../../Sample'

export class Home extends React.Component {
  constructor (props) {
    super(props)
    this.state = {
      news: Sample.newsHome,
      categories: Sample.categoriesHome,
      infoUrl: Sample.infoUrl
    }
  }
  render () {
    return (
      <div id={'home'}>
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
        <InfoUrl url={this.state.infoUrl.url} text={this.state.infoUrl.text} />
        <Footer />
      </div>
    )
  }
}

require('./Home.scss')

export default connect()(Home)
