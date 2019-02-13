import React from 'react'
import { connect } from 'react-redux'
import BeersView from './BeerView'

export class App extends React.Component {
  render () {
    return (
      <div>
        <BeersView />
      </div>
    )
  }
}

export default connect()(App)
