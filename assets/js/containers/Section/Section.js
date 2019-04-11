import React from 'react'
import { connect } from 'react-redux'
import Header from '../../components/Header/Header'
import Nav from '../../components/Nav/Nav'
import Slider from '../../components/Slider/Slider'
import Tile from '../../components/Tile/Tile'
import Footer from '../../components/Footer/Footer'
import * as Sample from '../../Sample'

export class Section extends React.Component {
  constructor (props) {
    super(props)
    this.state = {
      news: Sample.news,
      contents: Sample.contents,
      infoUrl: Sample.infoUrl
    }
  }
  render () {
    return (
      <div id={'section'}>
        <Header />
        <Nav />
        <div className={'box'}>
          <Slider className={'slider'} items={this.state.news}>
            <div className={'content'}>
              {
                this.state.contents.map((tile, index) => (
                  <Tile key={index} item={tile} />
                ))
              }
              <div className={'search'}><input type={'text'} placeholder={'Rechercher'} /></div>
            </div>
          </Slider>
        </div>
        <Footer />
      </div>
    )
  }
}

require('./Section.scss')

export default connect()(Section)
