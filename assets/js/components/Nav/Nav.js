import React from 'react'
import { connect } from 'react-redux'
import * as Sample from '../../Sample'

export class Nav extends React.Component {
  constructor (props) {
    super(props)
    this.state = {
      sections: Sample.sections,
      contents: Sample.contents
    }
  }
  render () {
    return (
      <nav id={'nav'}>
        <ul>
          <li><a href={'#'} className={'news'}>Actualités</a></li>
          {
            this.state.sections.map((section, index) => (
              <li key={index}><a href={section.url} className={'section'} style={{ backgroundColor: section.color }}>{section.title}</a></li>
            ))
          }
        </ul>
      </nav>
    )
  }
}

require('./Nav.scss')

export default connect()(Nav)
