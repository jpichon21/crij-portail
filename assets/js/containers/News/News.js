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
      totalNews: 27,
      currentPage: 1
    }
    this.pagination = this.pagination.bind(this)
  }
  pagination () {
    let pagination = []
    let totalPages = Math.ceil(this.state.totalNews / 6)
    for (let i = 1; i < totalPages + 1; i++) {
      pagination.push(
        <a key={i} className={this.state.currentPage === i ? 'active' : ''} href={`page/${i}`}>{i}</a>
      )
    }
    return (
      <div className={'pagination'}>
        {pagination}
      </div>
    )
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
            <div className={'articles'}>
              {
                this.state.news.map((article, index) => (
                  <a key={index} href={article.url} className={'article'}>
                    <span className={'parent'} style={{ backgroundColor: article.parent.color }}>
                      {article.parent.title}
                    </span>
                    <div className={'thumb'}>
                      <div className={'image'} style={{ backgroundImage: `url(${article.image})` }} />
                    </div>
                    <h2>{article.title}</h2>
                    <p>{article.excerpt}</p>
                  </a>
                ))
              }
            </div>
            <div className={'pagination'}>
              {this.pagination()}
            </div>
          </div>
        </div>
        <Footer />
      </div>
    )
  }
}

require('./News.scss')

export default connect()(News)
