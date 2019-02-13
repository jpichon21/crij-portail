// import { combineReducers } from 'redux'
import reduceReducers from 'reduce-reducers'
import beers from './beers'

// export default combineReducers({
//   beers
// })
export default reduceReducers(beers)
