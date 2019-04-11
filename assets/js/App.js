import React from 'react'
import { connect } from 'react-redux'
import '@fortawesome/fontawesome-free/js/all'
// import Home from './containers/Home/Home'
// import Category from './containers/Category/Category'
import Section from './containers/Section/Section'

export class App extends React.Component {
  render () {
    return (
      // <Home />
      // <Category />
      <Section />
    )
  }
}

require('./App.scss')

export default connect()(App)
