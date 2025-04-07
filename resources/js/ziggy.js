const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"adminlte.darkmode.toggle":{"uri":"adminlte\/darkmode\/toggle","methods":["POST"]},"\/":{"uri":"\/","methods":["GET","HEAD"]},"users":{"uri":"Users","methods":["GET","HEAD"]},"storage.local":{"uri":"storage\/{path}","methods":["GET","HEAD"],"wheres":{"path":".*"},"parameters":["path"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
  Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
