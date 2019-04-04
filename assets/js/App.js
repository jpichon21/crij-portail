import React from 'react'
// import { connect } from 'react-redux'
import '@fortawesome/fontawesome-free/js/all'
import Home from './containers/Home/Home'

export class App extends React.Component {
  render () {
    return (
      <Home />
    )
  }
}

require('./App.scss')

// export default connect()(App)
export default App
