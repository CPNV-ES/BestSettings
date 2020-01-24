const { app, BrowserWindow, ipcMain } = require('electron')

function createWindow () {
  // Cree la fenetre du navigateur.
  let win = new BrowserWindow({
    width: 1080,
    height: 920,
    icon: __dirname + '/BS.jpg',
    webPreferences: {
      nodeIntegration: true,
      webSecurity: false,
      allowDisplayingInsecureContent: true,
      allowRunningInsecureContent: true,
    }
  })

  // and load the index.html of the app.
  win.loadFile('./views/index.html')
}
