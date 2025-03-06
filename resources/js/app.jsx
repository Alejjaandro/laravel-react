import React from 'react'
import ReactDOM from 'react-dom/client'
import 'bootstrap/dist/css/bootstrap.min.css'

const App = () => {
  return (
    <div>
      <h1>Hello world</h1>
      <button className='btn btn-success'>csjhdgfsjhdfg</button>
    </div>
  )
}

export default App

if (document.getElementById('app')) {
  const Index = ReactDOM.createRoot(document.getElementById('app'))
  Index.render(
    <React.StrictMode>
      <App />
    </React.StrictMode>
  )
}