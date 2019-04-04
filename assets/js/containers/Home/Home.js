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
      news: Sample.news,
      links: Sample.links
    }
  }
  render () {
    return (
      <div id={'home'}>
        <Header />
        <div className={'box'}>
          <Slider className={'slider'} items={this.state.news}>
            <div className={'content'}>
              <div className={'row'}>
                <Tile item={Sample.links[0]} />
                <Tile item={Sample.links[1]} />
                <Tile item={Sample.links[2]} />
                <Tile item={Sample.links[3]} />
                <Tile item={Sample.links[4]} />
              </div>
              <input type={'text'} className={'search'} placeholder={'Rechercher'} />
              <div className={'row'}>
                <Tile item={Sample.links[5]} />
                <Tile item={Sample.links[6]} />
                <Tile item={Sample.links[7]} />
                <Tile item={Sample.links[8]} />
                <Tile item={Sample.links[9]} />
              </div>
            </div>
          </Slider>
        </div>
        <InfoUrl url={Sample.info.url} text={Sample.info.text} />
        <Footer />
      </div>
    )
  }
}

require('./Home.scss')

export default connect()(Home)
