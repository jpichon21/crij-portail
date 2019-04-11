import React from 'react'
import { connect } from 'react-redux'
import Header from '../../components/Header/Header'
import Footer from '../../components/Footer/Footer'
import * as Sample from '../../Sample'

export class News extends React.Component {
  constructor (props) {
    super(props)
    this.state = {
      background: Sample.backgroundNews,
      news: Sample.news,
      sections: Sample.sections,
      infoUrl: Sample.infoUrl
    }
  }
  render () {
    return (
      <div id={'news'}>
        <Header />
        <div className={'box'}>
          <div className={'background'} style={{ backgroundImage: `url(${this.state.background})` }} />
          <div className={'search'}><input type={'text'} placeholder={'Rechercher'} /></div>
          <div className={'column'}>
            <h1>Les actualités</h1>
          </div>
        </div>
        <Footer />
      </div>
    )
  }
}

require('./News.scss')

export default connect()(News)
