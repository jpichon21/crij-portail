import React from 'react'
import { render } from 'react-dom'
import { Provider } from 'react-redux'
import { configureStore } from './store'
// import rootReducer from './reducers'
import App from './components/App'

// const store = createStore(rootReducer, window.__REDUX_DEVTOOLS_EXTENSION__ && window.__REDUX_DEVTOOLS_EXTENSION__()
// )
const store = configureStore({})
window.store = store

render(
  <Provider store={store}>
    <App />
  </Provider>,
  document.getElementById('app')
)
