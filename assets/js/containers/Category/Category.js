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
      newsCategory: Sample.newsCategory,
      tilesCategory: Sample.tilesCategory
    }
  }
  render () {
    return (
      <div id={'category'}>
        <Header />
        <div className={'box'}>
          <Slider className={'slider'} items={this.state.newsCategory}>
            <div className={'content'}>
              <div className={'search'}><input type={'text'} placeholder={'Rechercher'} /></div>
              {
                Sample.tilesCategory.map(tile => (
                  <Tile item={tile} />
                ))
              }
            </div>
          </Slider>
        </div>
        <InfoUrl url={Sample.infoUrl.url} text={Sample.infoUrl.text} />
        <Footer />
      </div>
    )
  }
}

require('./Category.scss')

export default connect()(Category)
