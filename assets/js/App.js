import React from 'react'
import { connect } from 'react-redux'
import '@fortawesome/fontawesome-free/js/all'
// import Home from './containers/Home/Home'
import Category from './containers/Category/Category'

export class App extends React.Component {
  render () {
    return (
      // <Home />
      <Category />
    )
  }
}

require('./App.scss')

export default connect()(App)
