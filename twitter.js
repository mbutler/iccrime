new TWTR.Widget({
  version: 2,
  type: 'search',
  search: '#iccrime',
  interval: 10000,
  title: '#iccrime',
  subject: '',
  width: 350,
  height: 75,
  theme: {
    shell: {
      background: '#8ec1da',
      color: '#ffffff'
    },
    tweets: {
      background: '#ffffff',
      color: '#444444',
      links: '#1985b5'
    }
  },
  features: {
    scrollbar: true,
    loop: true,
    live: true,
    hashtags: true,
    timestamp: true,
    avatars: false,
    toptweets: true,
    behavior: 'default'
  }
}).render().start();