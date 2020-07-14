<?php

/**

 * Plugin Name: WEBKITS Real Estate Api

 * Plugin URI: https://mywebkit.ca

 * Description: Search and Display Real Estate Listings

 * Version: 3.090

 * Author: Curious Projects

 **/



/*error_reporting(E_ERROR | E_WARNING | E_PARSE);

ini_set('display_errors', 1); */


require 'includes/updater.php';

$MyUpdateChecker = PucFactory::buildUpdateChecker(

	'https://curiouscloud.ca/plugin/metadata.json',

	__FILE__,

	'webkits'

);

global $crawlers;

global $crawler, $User_Perm,$User_Logged,$email;
//echo var_dump($User_Logged);die;

//$dbHost = 'http://159.203.14.115/';

//$dbHost = 'http://webkitadmin.com/';

//$dbHost = 'http://webkitadmin.project:7700/';





define('SOLD_PASSWORD','KiyaCat13#^');

$crawlers = array(

	'.*Java.*outbrain',

	' YLT',

	'^b0t$',

	'^bluefish ',

	'^Calypso v\/',

	'^COMODO DCV',

	'^DangDang',

	'^DavClnt',

	'^FDM ',

	'^git\/',

	'^Goose\/',

	'^Grabber',

	'^HTTPClient\/',

	'^Java\/',

	'^Jeode\/',

	'^Jetty\/',

	'^Mail\/',

	'^Mget',

	'^Microsoft URL Control',

	'^NG\/[0-9\.]',

	'^NING\/',

	'^PHP\/[0-9]',

	'^RMA\/',

	'^Ruby|Ruby\/[0-9]',

	'^VSE\/[0-9]',

	'^WordPress\.com',

	'^XRL\/[0-9]',

	'^ZmEu',

	'008\/',

	'13TABS',

	'192\.comAgent',

	'2ip\.ru',

	'404enemy',

	'7Siters',

	'80legs',

	'a\.pr-cy\.ru',

	'a3logics\.in',

	'A6-Indexer',

	'Abonti',

	'Aboundex',

	'aboutthedomain',

	'Accoona-AI-Agent',

	'acoon',

	'acrylicapps\.com\/pulp',

	'Acunetix',

	'AdAuth\/',

	'adbeat',

	'AddThis',

	'ADmantX',

	'AdminLabs',

	'adressendeutschland',

	'adscanner',

	'Adstxtaggregator',

	'agentslug',

	'AHC',

	'aihit',

	'aiohttp\/',

	'Airmail',

	'akka-http\/',

	'akula\/',

	'alertra',

	'alexa site audit',

	'Alibaba\.Security\.Heimdall',

	'Alligator',

	'allloadin',

	'AllSubmitter',

	'alyze\.info',

	'amagit',

	'Anarchie',

	'AndroidDownloadManager',

	'Anemone',

	'AngleSharp',

	'annotate_google',

	'Ant\.com',

	'Anturis Agent',

	'AnyEvent-HTTP\/',

	'Apache Droid',

	'Apache OpenOffice',

	'Apache-HttpAsyncClient',

	'Apache-HttpClient',

	'ApacheBench',

	'Apexoo',

	'APIs-Google',

	'AportWorm\/',

	'AppBeat\/',

	'AppEngine-Google',

	'AppStoreScraperZ',

	'Aprc\/[0-9]',

	'Arachmo',

	'arachnode',

	'Arachnophilia',

	'aria2',

	'Arukereso',

	'asafaweb',

	'AskQuickly',

	'Ask Jeeves',

	'ASPSeek',

	'Asterias',

	'Astute',

	'asynchttp',

	'Attach',

	'autocite',

	'Autonomy',

	'axios\/',

	'B-l-i-t-z-B-O-T',

	'Backlink-Ceck',

	'backlink-check',

	'BacklinkHttpStatus',

	'BackStreet',

	'BackWeb',

	'Bad-Neighborhood',

	'Badass',

	'baidu\.com',

	'Bandit',

	'basicstate',

	'BatchFTP',

	'Battleztar Bazinga',

	'baypup\/',

	'BazQux',

	'BBBike',

	'BCKLINKS',

	'BDFetch',

	'BegunAdvertising',

	'Bidtellect',

	'BigBozz',

	'Bigfoot',

	'biglotron',

	'BingLocalSearch',

	'BingPreview',

	'binlar',

	'biNu image cacher',

	'Bitacle',

	'biz_Directory',

	'Black Hole',

	'Blackboard Safeassign',

	'BlackWidow',

	'BlockNote\.Net',

	'Bloglines',

	'Bloglovin',

	'BlogPulseLive',

	'BlogSearch',

	'Blogtrottr',

	'BlowFish',

	'boitho\.com-dc',

	'BPImageWalker',

	'Braintree-Webhooks',

	'Branch Metrics API',

	'Branch-Passthrough',

	'Brandprotect',

	'BrandVerity',

	'Brandwatch',

	'Brodie\/',

	'Browsershots',

	'BUbiNG',

	'Buck\/',

	'Buddy',

	'BuiltWith',

	'Bullseye',

	'BunnySlippers',

	'Burf Search',

	'Butterfly\/',

	'BuzzSumo',

	'CAAM\/[0-9]',

	'CakePHP',

	'Calculon',

	'Canary%20Mail',

	'CaretNail',

	'catexplorador',

	'CC Metadata Scaper',

	'Cegbfeieh',

	'censys',

	'Cerberian Drtrs',

	'CERT\.at-Statistics-Survey',

	'cg-eye',

	'changedetection',

	'ChangesMeter',

	'Charlotte',

	'CheckHost',

	'checkprivacy',

	'CherryPicker',

	'ChinaClaw',

	'Chirp\/',

	'chkme\.com',

	'Chlooe',

	'Chromaxa',

	'CirrusExplorer',

	'CISPA Vulnerability Notification',

	'Citoid',

	'CJNetworkQuality',

	'Clarsentia',

	'clips\.ua\.ac\.be',

	'Cloud mapping',

	'CloudEndure',

	'CloudFlare-AlwaysOnline',

	'Cloudinary',

	'cmcm\.com',

	'coccoc',

	'cognitiveseo',

	'colly -',

	'CommaFeed',

	'Commons-HttpClient',

	'commonscan',

	'contactbigdatafr',

	'contentkingapp',

	'convera',

	'CookieReports',

	'copyright sheriff',

	'CopyRightCheck',

	'Copyscape',

	'Cosmos4j\.feedback',

	'Covario-IDS',

	'Crescent',

	'Crowsnest',

	'Criteo',

	'CSHttp',

	'curb',

	'Curious George',

	'curl',

	'cuwhois\/',

	'cybo\.com',

	'DAP\/NetHTTP',

	'DareBoost',

	'DatabaseDriverMysqli',

	'DataCha0s',

	'Datafeedwatch',

	'Datanyze',

	'DataparkSearch',

	'dataprovider',

	'DataXu',

	'Daum(oa)?[ \/][0-9]',

	'ddline',

	'deeris',

	'Demon',

	'DeuSu',

	'developers\.google\.com\/\+\/web\/snippet\/',

	'Devil',

	'Digg',

	'Digincore',

	'DigitalPebble',

	'Dirbuster',

	'Discourse Forum Onebox',

	'Disqus\/',

	'Dispatch\/',

	'DittoSpyder',

	'dlvr',

	'DMBrowser',

	'DNSPod-reporting',

	'docoloc',

	'Dolphin http client',

	'DomainAppender',

	'Donuts Content Explorer',

	'dotMailer content retrieval',

	'dotSemantic',

	'downforeveryoneorjustme',

	'Download Wonder',

	'downnotifier',

	'DowntimeDetector',

	'Drip',

	'drupact',

	'Drupal \(\+http:\/\/drupal\.org\/\)',

	'DTS Agent',

	'dubaiindex',

	'EARTHCOM',

	'Easy-Thumb',

	'EasyDL',

	'Ebingbong',

	'ec2linkfinder',

	'eCairn-Grabber',

	'eCatch',

	'ECCP',

	'eContext\/',

	'Ecxi',

	'EirGrabber',

	'ElectricMonk',

	'elefent',

	'EMail Exractor',

	'EMail Wolf',

	'EmailWolf',

	'Embarcadero',

	'Embed PHP Library',

	'Embedly',

	'endo\/',

	'europarchive\.org',

	'evc-batch',

	'EventMachine HttpClient',

	'Everwall Link Expander',

	'Evidon',

	'Evrinid',

	'ExactSearch',

	'ExaleadCloudview',

	'Excel\/',

	'exif',

	'Exploratodo',

	'Express WebPictures',

	'Extreme Picture Finder',

	'EyeNetIE',

	'ezooms',

	'fairshare',

	'Faraday v',

	'fasthttp',

	'Faveeo',

	'Favicon downloader',

	'faviconkit',

	'faviconarchive',

	'FavOrg',

	'Feed Wrangler',

	'Feedable\/',

	'Feedbin',

	'FeedBooster',

	'FeedBucket',

	'FeedBunch\/',

	'FeedBurner',

	'feeder',

	'Feedly',

	'FeedshowOnline',

	'Feedspot',

	'Feedwind\/',

	'FeedZcollector',

	'feeltiptop',

	'Fetch API',

	'Fetch\/[0-9]',

	'Fever\/[0-9]',

	'FHscan',

	'Fimap',

	'findlink',

	'findthatfile',

	'FlashGet',

	'FlipboardBrowserProxy',

	'FlipboardProxy',

	'FlipboardRSS',

	'Flock\/',

	'fluffy',

	'Flunky',

	'flynxapp',

	'forensiq',

	'FoundSeoTool',

	'http:\/\/www.neomo.de\/', //'Francis [Bot]'

	'free thumbnails',

	'Freeuploader',

	'Funnelback',

	'G-i-g-a-b-o-t',

	'g00g1e\.net',

	'ganarvisitas',

	'geek-tools',

	'Genieo',

	'GentleSource',

	'GetCode',

	'Getintent',

	'GetLinkInfo',

	'getprismatic',

	'GetRight',

	'getroot',

	'GetURLInfo\/',

	'GetWeb',

	'Ghost Inspector',

	'GigablastOpenSource',

	'GIS-LABS',

	'github-camo',

	'github\.com',

	'Go [\d\.]* package http',

	'Go http package',

	'Go-Ahead-Got-It',

	'Go-http-client',

	'Go!Zilla',

	'gobyus',

	'gofetch',

	'GomezAgent',

	'gooblog',

	'Goodzer\/',

	'Google AppsViewer',

	'Google Desktop',

	'Google favicon',

	'Google Keyword Suggestion',

	'Google Keyword Tool',

	'Google Page Speed Insights',

	'Google PP Default',

	'Google Search Console',

	'Google Web Preview',

	'Google-Adwords',

	'Google-Apps-Script',

	'Google-Calendar-Importer',

	'Google-HotelAdsVerifier',

	'Google-HTTP-Java-Client',

	'Google-Publisher-Plugin',

	'Google-SearchByImage',

	'Google-Site-Verification',

	'Google-Structured-Data-Testing-Tool',

	'Google-Youtube-Links',

	'google-xrawler',

	'GoogleDocs',

	'GoogleHC\/',

	'GoogleProducer',

	'GoogleSites',

	'Google-Transparency-Report',

	'Gookey',

	'GoScraper',

	'GoSpotCheck',

	'gosquared-thumbnailer',

	'Gotit',

	'GoZilla',

	'grabify',

	'GrabNet',

	'Grafula',

	'Grammarly',

	'GrapeFX',

	'GreatNews',

	'Gregarius',

	'GRequests',

	'grokkit',

	'grouphigh',

	'grub-client',

	'gSOAP\/',

	'GT::WWW',

	'GTmetrix',

	'GuzzleHttp',

	'gvfs\/',

	'HAA(A)?RTLAND http client',

	'Haansoft',

	'hackney\/',

	'Hadi Agent',

	'HappyApps-WebCheck',

	'Hatena',

	'Havij',

	'HeadlessChrome',

	'HEADMasterSEO',

	'HeartRails_Capture',

	'help@dataminr\.com',

	'heritrix',

	'historious',

	'hkedcity',

	'hledejLevne\.cz',

	'Hloader',

	'HMView',

	'Holmes',

	'HonesoSearchEngine',

	'HootSuite Image proxy',

	'Hootsuite-WebFeed',

	'hosterstats',

	'HostTracker',

	'ht:\/\/check',

	'htdig',

	'HTMLparser',

	'htmlyse',

	'HTTP Banner Detection',

	'HTTP_Compression_Test',

	'http_request2',

	'http_requester',

	'http-get',

	'HTTP-Header-Abfrage',

	'http-kit',

	'http-request\/',

	'HTTP-Tiny',

	'HTTP::Lite',

	'http\.rb\/',

	'http_get',

	'HttpComponents',

	'httphr',

	'HTTPMon',

	'httpRequest',

	'httpscheck',

	'httpssites_power',

	'httpunit',

	'HttpUrlConnection',

	'httrack',

	'huaweisymantec',

	'HubSpot ',

	'Humanlinks',

	'i2kconnect\/',

	'Iblog',

	'ichiro',

	'Id-search',

	'IdeelaborPlagiaat',

	'IDG Twitter Links Resolver',

	'IDwhois\/',

	'Iframely',

	'igdeSpyder',

	'IlTrovatore',

	'Image Fetch',

	'Image Sucker',

	'ImageEngine\/',

	'ImageVisu\/',

	'Imagga',

	'imagineeasy',

	'imgsizer',

	'InAGist',

	'inbound\.li parser',

	'InDesign%20CC',

	'Indy Library',

	'InetURL',

	'infegy',

	'infohelfer',

	'InfoTekies',

	'InfoWizards Reciprocal Link',

	'inpwrd\.com',

	'instabid',

	'Instapaper',

	'Integrity',

	'integromedb',

	'Intelliseek',

	'InterGET',

	'internet_archive',

	'Internet Ninja',

	'InternetSeer',

	'internetVista monitor',

	'intraVnews',

	'IODC',

	'IOI',

	'iplabel',

	'ips-agent',

	'IPS\/[0-9]',

	'IPWorks HTTP\/S Component',

	'iqdb\/',

	'Iria',

	'Irokez',

	'isitup\.org',

	'iskanie',

	'isUp\.li',

	'iThemes Sync\/',

	'iZSearch',

	'JAHHO',

	'janforman',

	'Jaunt\/',

	'Jbrofuzz',

	'Jersey\/',

	'JetCar',

	'Jigsaw',

	'Jobboerse',

	'JobFeed discovery',

	'Jobg8 URL Monitor',

	'jobo',

	'Jobrapido',

	'Jobsearch1\.5',

	'JoinVision Generic',

	'JolokiaPwn',

	'Joomla',

	'Jorgee',

	'JS-Kit',

	'JustView',

	'Kaspersky Lab CFR link resolver',

	'Kelny\/',

	'Kerrigan\/',

	'KeyCDN',

	'Keyword Density',

	'Keywords Research',

	'KickFire',

	'KimonoLabs\/',

	'Kml-Google',

	'knows\.is',

	'KOCMOHABT',

	'kouio',

	'kube-probe',

	'kulturarw3',

	'KumKie',

	'L\.webis',

	'Larbin',

	'Lavf\/',

	'LeechFTP',

	'LeechGet',

	'letsencrypt',

	'Lftp',

	'LibVLC',

	'LibWeb',

	'Libwhisker',

	'libwww',

	'Licorne',

	'Liferea\/',

	'Lightspeedsystems',

	'Lighthouse',

	'Likse',

	'Link Valet',

	'link_thumbnailer',

	'LinkAlarm\/',

	'linkCheck',

	'linkdex',

	'LinkExaminer',

	'linkfluence',

	'linkpeek',

	'LinkPreviewGenerator',

	'LinkScan',

	'LinksManager',

	'LinkTiger',

	'LinkWalker',

	'Lipperhey',

	'Litemage_walker',

	'livedoor ScreenShot',

	'LoadImpactRload',

	'localsearch-web',

	'LongURL API',

	'looksystems\.net',

	'ltx71',

	'lua-resty-http',

	'lwp-request',

	'lwp-trivial',

	'LWP::Simple',

	'lycos',

	'LYT\.SR',

	'mabontland',

	'Mag-Net',

	'MagpieRSS',

	'Mail\.Ru',

	'MailChimp',

	'Majestic12',

	'makecontact\/',

	'Mandrill',

	'MapperCmd',

	'marketinggrader',

	'MarkMonitor',

	'MarkWatch',

	'Mass Downloader',

	'masscan\/',

	'Mata Hari',

	'Mediametric',

	'Mediapartners-Google',

	'mediawords',

	'MegaIndex\.ru',

	'MeltwaterNews',

	'Melvil Rawi',

	'MemGator',

	'Metaspinner',

	'MetaURI',

	'MFC_Tear_Sample',

	'Microsearch',

	'Microsoft Office ',

	'Microsoft Outlook',

	'Microsoft Windows Network Diagnostics',

	'Microsoft-WebDAV-MiniRedir',

	'Microsoft Data Access',

	'MIDown tool',

	'MIIxpc',

	'Mindjet',

	'Miniature\.io',

	'Miniflux',

	'Mister PiX',

	'mixdata dot com',

	'mixed-content-scan',

	'Mixmax-LinkPreview',

	'mixnode',

	'Mnogosearch',

	'mogimogi',

	'Mojeek',

	'Mojolicious \(Perl\)',

	'Monit\/',

	'monitis',

	'Monitority\/',

	'montastic',

	'MonTools',

	'Moreover',

	'Morfeus Fucking Scanner',

	'Morning Paper',

	'MovableType',

	'mowser',

	'Mrcgiguy',

	'MS Web Services Client Protocol',

	'MSFrontPage',

	'mShots',

	'MuckRack\/',

	'muhstik-scan',

	'MVAClient',

	'MxToolbox\/',

	'nagios',

	'Najdi\.si',

	'Name Intelligence',

	'Nameprotect',

	'Navroad',

	'NearSite',

	'Needle',

	'Nessus',

	'Net Vampire',

	'NetAnts',

	'NETCRAFT',

	'NetLyzer',

	'NetMechanic',

	'NetNewsWire',

	'Netpursual',

	'netresearch',

	'NetShelter ContentScan',

	'Netsparker',

	'NetTrack',

	'Netvibes',

	'NetZIP',

	'Neustar WPM',

	'NeutrinoAPI',

	'NewRelicPinger',

	'NewsBlur .*Finder',

	'NewsGator',

	'newsme',

	'newspaper\/',

	'Nexgate Ruby Client',

	'NG-Search',

	'Nibbler',

	'NICErsPRO',

	'Nikto',

	'nineconnections',

	'NLNZ_IAHarvester',

	'Nmap Scripting Engine',

	'node-superagent',

	'node-urllib',

	'node\.io',

	'Nodemeter',

	'NodePing',

	'nominet\.org\.uk',

	'nominet\.uk',

	'Norton-Safeweb',

	'Notifixious',

	'notifyninja',

	'nuhk',

	'nutch',

	'Nuzzel',

	'nWormFeedFinder',

	'nyawc\/',

	'Nymesis',

	'NYU',

	'Ocelli\/',

	'Octopus',

	'oegp',

	'Offline Explorer',

	'Offline Navigator',

	'og-scraper',

	'okhttp',

	'omgili',

	'OMSC',

	'Online Domain Tools',

	'OpenCalaisSemanticProxy',

	'Openfind',

	'OpenLinkProfiler',

	'Openstat\/',

	'OpenVAS',

	'Optimizer',

	'Orbiter',

	'OrgProbe\/',

	'orion-semantics',

	'Outlook-Express',

	'Outlook-iOS',

	'ow\.ly',

	'Owler',

	'ownCloud News',

	'OxfordCloudService',

	'Page Valet',

	'page_verifier',

	'page scorer',

	'page2rss',

	'PageGrabber',

	'PagePeeker',

	'PageScorer',

	'Pagespeed\/',

	'Panopta',

	'panscient',

	'Papa Foto',

	'parsijoo',

	'Pavuk',

	'PayPal IPN',

	'pcBrowser',

	'Pcore-HTTP',

	'Pearltrees',

	'PECL::HTTP',

	'peerindex',

	'Peew',

	'PeoplePal',

	'Perlu -',

	'PhantomJS Screenshoter',

	'PhantomJS\/',

	'Photon\/',

	'phpservermon',

	'Pi-Monster',

	'Picscout',

	'Picsearch',

	'PictureFinder',

	'Pimonster',

	'ping\.blo\.gs',

	'Pingability',

	'PingAdmin\.Ru',

	'Pingdom',

	'Pingoscope',

	'PingSpot',

	'pinterest\.com',

	'Pixray',

	'Pizilla',

	'Plagger\/',

	'Ploetz \+ Zeller',

	'Plukkie',

	'plumanalytics',

	'PocketImageCache',

	'PocketParser',

	'Pockey',

	'POE-Component-Client-HTTP',

	'Polymail\/',

	'Pompos',

	'Porkbun',

	'Port Monitor',

	'postano',

	'PostmanRuntime',

	'PostPost',

	'postrank',

	'PowerPoint\/',

	'Priceonomics Analysis Engine',

	'PrintFriendly',

	'PritTorrent',

	'Prlog',

	'probethenet',

	'Project 25499',

	'prospectb2b',

	'Protopage',

	'ProWebWalker',

	'proximic',

	'PRTG Network Monitor',

	'pshtt, https scanning',

	'PTST ',

	'PTST\/[0-9]+',

	'Pulsepoint XT3 web scraper',

	'Pump',

	'Python-httplib2',

	'python-requests',

	'Python-urllib',

	'Qirina Hurdler',

	'QQDownload',

	'QrafterPro',

	'Qseero',

	'Qualidator',

	'QueryN Metasearch',

	'queuedriver',

	'Quora Link Preview',

	'Qwantify',

	'Radian6',

	'RankActive',

	'RankFlex',

	'RankSonicSiteAuditor',

	'Re-re Studio',

	'ReactorNetty',

	'Readability',

	'RealDownload',

	'RealPlayer%20Downloader',

	'RebelMouse',

	'Recorder',

	'RecurPost\/',

	'redback\/',

	'ReederForMac',

	'ReGet',

	'RepoMonkey',

	'request\.js',

	'reqwest\/',

	'ResponseCodeTest',

	'RestSharp',

	'Riddler',

	'Rival IQ',

	'Robosourcer',

	'Robozilla',

	'ROI Hunter',

	'RPT-HTTPClient',

	'RSSOwl',

	'safe-agent-scanner',

	'SalesIntelligent',

	'Saleslift',

	'Sendsay\.Ru',

	'SauceNAO',

	'SBIder',

	'scalaj-http',

	'scan\.lol',

	'ScanAlert',

	'Scoop',

	'scooter',

	'ScoutJet',

	'ScoutURLMonitor',

	'ScrapeBox Page Scanner',

	'SimpleScraper',

	'Scrapy',

	'Screaming',

	'ScreenShotService',

	'Scrubby',

	'Scrutiny\/',

	'search\.thunderstone',

	'Search37',

	'searchenginepromotionhelp',

	'Searchestate',

	'SearchExpress',

	'SearchSight',

	'Seeker',

	'semanticdiscovery',

	'semanticjuice',

	'Semiocast HTTP client',

	'Semrush',

	'sentry\/',

	'SEO Browser',

	'Seo Servis',

	'seo-nastroj\.cz',

	'seo4ajax',

	'Seobility',

	'SEOCentro',

	'SeoCheck',

	'SEOkicks',

	'Seomoz',

	'SEOprofiler',

	'SEOsearch',

	'seoscanners',

	'seositecheckup',

	'SEOstats',

	'servernfo',

	'sexsearcher',

	'Seznam',

	'Shelob',

	'Shodan',

	'Shoppimon',

	'ShopWiki',

	'ShortLinkTranslate',

	'shrinktheweb',

	'Sideqik',

	'SimplePie',

	'SimplyFast',

	'Siphon',

	'SISTRIX',

	'Site-Shot\/',

	'Site Sucker',

	'Site24x7',

	'SiteBar',

	'Sitebeam',

	'Sitebulb\/',

	'SiteCondor',

	'SiteExplorer',

	'SiteGuardian',

	'Siteimprove',

	'SiteIndexed',

	'Sitemap(s)? Generator',

	'SitemapGenerator',

	'SiteMonitor',

	'Siteshooter B0t',

	'SiteSnagger',

	'SiteSucker',

	'SiteTruth',

	'Sitevigil',

	'sitexy\.com',

	'SkypeUriPreview',

	'Slack\/',

	'slider\.com',

	'slurp',

	'SlySearch',

	'SmartDownload',

	'SMRF URL Expander',

	'SMUrlExpander',

	'Snake',

	'Snappy',

	'SnapSearch',

	'Snarfer\/',

	'SniffRSS',

	'sniptracker',

	'Snoopy',

	'SnowHaze Search',

	'sogou web',

	'SortSite',

	'Sottopop',

	'sovereign\.ai',

	'SpaceBison',

	'SpamExperts',

	'Spammen',

	'Spanner',

	'spaziodati',

	'SPDYCheck',

	'Specificfeeds',

	'speedy',

	'SPEng',

	'Spinn3r',

	'spray-can',

	'Sprinklr ',

	'spyonweb',

	'sqlmap',

	'Sqlworm',

	'Sqworm',

	'SSL Labs',

	'ssl-tools',

	'StackRambler',

	'Statastico\/',

	'StatusCake',

	'Steeler',

	'Stratagems Kumo',

	'Stroke\.cz',

	'StudioFACA',

	'StumbleUpon',

	'suchen',

	'Sucuri',

	'summify',

	'SuperHTTP',

	'Surphace Scout',

	'Suzuran',

	'SwiteScraper',

	'Symfony BrowserKit',

	'Symfony2 BrowserKit',

	'SynHttpClient-Built',

	'Sysomos',

	'sysscan',

	'Szukacz',

	'T0PHackTeam',

	'tAkeOut',

	'Tarantula\/',

	'Taringa UGC',

	'TarmotGezgin',

	'Teleport',

	'Telesoft',

	'Telesphoreo',

	'Telesphorep',

	'Tenon\.io',

	'teoma',

	'terrainformatica',

	'Test Certificate Info',

	'testuri',

	'Tetrahedron',

	'TextRazor Downloader',

	'The Drop Reaper',

	'The Expert HTML Source Viewer',

	'The Knowledge AI',

	'The Intraformant',

	'theinternetrules',

	'TheNomad',

	'Thinklab',

	'Thumbshots',

	'ThumbSniper',

	'timewe\.net',

	'TinEye',

	'Tiny Tiny RSS',

	'TLSProbe\/',

	'Toata',

	'topster',

	'touche\.com',

	'Traackr\.com',

	'tracemyfile',

	'Trackuity',

	'TrapitAgent',

	'Trendiction',

	'Trendsmap',

	'trendspottr',

	'truwoGPS',

	'TryJsoup',

	'TulipChain',

	'Turingos',

	'Turnitin',

	'tweetedtimes',

	'Tweetminster',

	'Tweezler\/',

	'twibble',

	'Twice',

	'Twikle',

	'Twingly',

	'Twisted PageGetter',

	'Typhoeus',

	'ubermetrics-technologies',

	'uclassify',

	'UdmSearch',

	'unchaos',

	'unirest-java',

	'UniversalFeedParser',

	'Unshorten\.It',

	'Untiny',

	'UnwindFetchor',

	'updated',

	'updown\.io daemon',

	'Upflow',

	'Uptimia',

	'Urlcheckr',

	'URL Verifier',

	'URLitor',

	'urlresolver',

	'Urlstat',

	'URLTester',

	'UrlTrends Ranking Updater',

	'URLy Warning',

	'URLy\.Warning',

	'Vacuum',

	'Vagabondo',

	'VB Project',

	'vBSEO',

	'VCI',

	'via ggpht\.com GoogleImageProxy',

	'VidibleScraper',

	'Virusdie',

	'visionutils',

	'vkShare',

	'VoidEYE',

	'Voil',

	'voltron',

	'voyager\/',

	'VSAgent\/',

	'VSB-TUO\/',

	'Vulnbusters Meter',

	'VYU2',

	'w3af\.org',

	'W3C_Unicorn',

	'W3C-checklink',

	'W3C-mobileOK',

	'WAC-OFU',

	'Wallpapers\/[0-9]+',

	'WallpapersHD',

	'wangling',

	'Wappalyzer',

	'WatchMouse',

	'WbSrch\/',

	'WDT\.io',

	'web-capture\.net',

	'Web-sniffer',

	'Web Auto',

	'Web Collage',

	'Web Enhancer',

	'Web Fetch',

	'Web Fuck',

	'Web Pix',

	'Web Sauger',

	'Web spyder',

	'Web Sucker',

	'Webalta',

	'Webauskunft',

	'WebAuto',

	'WebCapture',

	'WebClient\/',

	'webcollage',

	'WebCookies',

	'WebCopier',

	'WebCorp',

	'WebDataStats',

	'WebDoc',

	'WebEnhancer',

	'WebFetch',

	'WebFuck',

	'WebGazer',

	'WebGo IS',

	'WebImageCollector',

	'WebImages',

	'WebIndex',

	'webkit2png',

	'WebLeacher',

	'webmastercoffee',

	'webmon ',

	'WebPix',

	'WebReaper',

	'WebSauger',

	'webscreenie',

	'Webshag',

	'Webshot',

	'Website Quester',

	'websitepulse agent',

	'WebsiteQuester',

	'Websnapr',

	'WebSniffer',

	'Webster',

	'WebStripper',

	'WebSucker',

	'Webthumb\/',

	'WebThumbnail',

	'WebWhacker',

	'WebZIP',

	'WeLikeLinks',

	'WEPA',

	'WeSEE',

	'wf84',

	'Wfuzz\/',

	'wget',

	'WhatsApp',

	'WhatsMyIP',

	'WhatWeb',

	'WhereGoes\?',

	'Whibse',

	'WhoRunsCoinHive',

	'Whynder Magnet',

	'Windows-RSS-Platform',

	'WinPodder',

	'wkhtmlto',

	'wmtips',

	'Woko',

	'woorankreview',

	'Word\/',

	'WordPress\/',

	'WordupinfoSearch',

	'wotbox',

	'WP Engine Install Performance API',

	'wpif',

	'wprecon\.com survey',

	'WPScan',

	'wscheck',

	'Wtrace',

	'WWW-Collector-E',

	'WWW-Mechanize',

	'WWW::Document',

	'WWW::Mechanize',

	'www\.monitor\.us',

	'WWWOFFLE',

	'x09Mozilla',

	'x22Mozilla',

	'XaxisSemanticsClassifier',

	'Xenu Link Sleuth',

	'XING-contenttabreceiver',

	'xpymep([0-9]?)\.exe',

	'Y!J-(ASR|BSC)',

	'Y\!J-BRW',

	'Yaanb',

	'yacy',

	'Yahoo Link Preview',

	'YahooCacheSystem',

	'YahooYSMcm',

	'YandeG',

	'Yandex(?!Search)',

	'yanga',

	'yeti',

	'Yo-yo',

	'Yoleo Consumer',

	'yoogliFetchAgent',

	'YottaaMonitor',

	'Your-Website-Sucks',

	'yourls\.org',

	'YoYs\.net',

	'YP\.PL',

	'Zabbix',

	'Zade',

	'Zao',

	'Zauba',

	'Zemanta Aggregator',

	'Zend_Http_Client',

	'Zend\\\\Http\\\\Client',

	'Zermelo',

	'Zeus ',

	'zgrab',

	'ZnajdzFoto',

	'Zombie\.js',

	'Zoom\.Mac',

	'ZyBorg',

	'[a-z0-9\-_]*(crawl|archiver|transcoder|spider|uptime|validator|fetcher|cron|checker|reader|extractor|monitoring|analyzer)',

);

$data = array(

	'Safari.[\d\.]*',

	'Firefox.[\d\.]*',

	' Chrome.[\d\.]*',

	'Chromium.[\d\.]*',

	'MSIE.[\d\.]',

	'Opera\/[\d\.]*',

	'Mozilla.[\d\.]*',

	'AppleWebKit.[\d\.]*',

	'Trident.[\d\.]*',

	'Windows NT.[\d\.]*',

	'Android [\d\.]*',

	'Macintosh.',

	'Ubuntu',

	'Linux',

	'[ ]Intel',

	'Mac OS X [\d_]*',

	'(like )?Gecko(.[\d\.]*)?',

	'KHTML,',

	'CriOS.[\d\.]*',

	'CPU iPhone OS ([0-9_])* like Mac OS X',

	'CPU OS ([0-9_])* like Mac OS X',

	'iPod',

	'compatible',

	'x86_..',

	'i686',

	'x64',

	'X11',

	'rv:[\d\.]*',

	'Version.[\d\.]*',

	'WOW64',

	'Win64',

	'Dalvik.[\d\.]*',

	' \.NET CLR [\d\.]*',

	'Presto.[\d\.]*',

	'Media Center PC',

	'BlackBerry',

	'Build',

	'Opera Mini\/\d{1,2}\.\d{1,2}\.[\d\.]*\/\d{1,2}\.',

	'Opera',

	' \.NET[\d\.]*',

	'cubot',

	'; M bot',

	'; CRONO',

	'; B bot',

	'; IDbot',

	'; ID bot',

	'; POWER BOT',

	';', // Remove the following characters ;

);

function crawlerDetect() {

	global $crawlers;



	if (

		isset($_SERVER['HTTP_USER_AGENT'])

		&& preg_match('[a-z0-9\-_]*(bot|crawl|archiver|transcoder|spider|uptime|validator|fetcher|cron|checker|reader|extractor|monitoring|analyzer)', $_SERVER['HTTP_USER_AGENT'])

	){

		return true;

	}

	else{

		return false;

	}

}

function isCrawler($userAgent = null)

{

	global $data , $crawlers;

	$compiledExclusions =  '('.implode('|', $data).')';

	$compiledRegex = '('.implode('|', $crawlers).')';



	$agent = trim(preg_replace(

		              "/{$compiledExclusions}/i",

		              '',

		              $userAgent

	              ));

	if ($agent == '') {

		return false;

	}

	$result = preg_match("/{$compiledRegex}/i", $agent, $matches);



	//$result = preg_match($compiledRegex, $_SERVER['HTTP_USER_AGENT']);



	return (bool) $result;

}

//$crawler = crawlerDetect();

$crawler = isCrawler($_SERVER['HTTP_USER_AGENT']);

//$crawler = true;


if(strpos($_SERVER['HTTP_HOST'], 'project') !== false)

{

	$dbHost = 'http://webkitadmin.project:7777/';

}

else{

	$dbHost = 'https://curiouscloud.ca/';

}


add_action( 'wp_loaded', 'webkits_listings_user' );

add_action('wp_loaded', 'webkits_override'); //Cache Flush

add_action('wp_enqueue_scripts', 'webkits_styles');  //CSS Files

add_action('wp_enqueue_scripts', 'webkits_js'); //JS Files


add_action('admin_menu', "webkits_options_menu"); //Options Menu - Webkits Options

add_action('init', 'webkits_listing_rewrite');  //Recreates the Link for SEO
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('template_redirect', 'rest_output_link_header', 11);
add_action('wp_head', 'webkits_og_tags');  //Create OG Meta for SEO

add_action('mp_library', 'extendTemplates', 11, 1); //MOTOPRESS - add new Template


add_action( 'rank_math/head','remove_og');
add_action( 'rank_math/frontend/description','remove_seo_og');
add_filter( 'wpseo_opengraph_url' , 'remove_seo_og' );
add_filter( 'wpseo_opengraph_desc', 'remove_seo_og' );
add_filter( 'wpseo_opengraph_title', 'remove_seo_og' );
add_filter( 'wpseo_opengraph_type', 'remove_seo_og' );
add_filter( 'wpseo_opengraph_site_name', 'remove_seo_og' );
add_filter( 'wpseo_opengraph_image' , 'remove_seo_og' );
add_filter( 'wpseo_og_og_image_width' , 'remove_seo_og' ); // v13.5 or older
add_filter( 'wpseo_og_og_image_height' , 'remove_seo_og' ); // v13.5 or older
add_filter( 'wpseo_opengraph_author_facebook' , 'remove_seo_og' );
add_filter( 'wpseo_metadesc' , 'remove_seo_og' );
remove_action('wp_head', 'rel_canonical');


add_filter( 'wp_nav_menu_items', 'wti_loginout_menu_link', 10, 2 );
add_filter('pre_get_document_title', 'webkits_title', 20, 3);  //Session + Header Rewrite

add_filter('wpseo_title', 'webkits_title');  //WPSEO Override

add_filter('language_attributes', 'add_og_xml_ns');  //XML Include for OG

add_filter('language_attributes', 'add_fb_xml_ns'); //XML Include for FB

add_filter('frm_to_email', 'custom_set_email_value', 10, 4); // FORMIDABLE - TeamLead To Address

add_filter('frm_email_message', 'add_email_header', 10, 2); // FORMIDABLE - TeamLead Body
add_filter('wp_mail_content_type', 'set_content_type'); // FORMIDABLE - TeamLead Body



add_shortcode("listings", "webkits_listings_sc"); // LISTINGS SHORTCODE
add_shortcode("login", "webkits_register_login"); // LISTINGS SHORTCODE
add_shortcode("user", "webkits_listings_user"); // LISTINGS SHORTCODE

/* section =    [listings, counter, listings-filtered,second-listings,map,full-search]

   filter  =    [openhouse, commercial, carriagetrade]

   from-city = City; filter by city

   onlyshow = agent | broker;

   maxprice = Number; maxprice

   postal = S1S,S1S,..; First 3 Letters of postal codes

   commerical = 1; Show commericals on no search

   lots = 1; show lots on no search */

add_shortcode("agents_page", "webkits_agents_shortcode"); //AGENTS SHORTCODE

/* section =    [agents,search] */

add_shortcode("agent", "webkits_agent_shortcode");  //AGENT DETAILS SHORTCODE

/* section =   [mini, name, bio, awards, social, testimonial, office, listings] */

add_shortcode("mainpage", "webkits_mainpage_shortcode"); // WIDGETS DETAILS SHORTCODE

/* section =   [search,openhouse,calculator,slider]

   class   =   ?

   type     = [random : lastest] - slider link*/

add_shortcode("seo", "webkits_seo_shortcode"); //SEO Shortcode

add_shortcode("details", "webkits_details_shortcode");  //LISTING DETAILS SHORTCODES

/* section =    [address, price, tags, pictures, remarks, BuildingInfo, FloorInfo

				thumbnails, gallery, image, MLS, Agent, Links, OpenHouse, calculator,

				map]

	col = Number; //Number of Coloumns for gallery section */





add_action('wp_ajax_nopriv_webkits_change_view', 'webkits_change_view'); // Save View for Listings

add_action('wp_ajax_webkits_change_view', 'webkits_change_view');

add_action('wp_ajax_nopriv_webkits_register', 'webkits_register');
add_action('wp_ajax_webkits_register', 'webkits_register');

add_action('wp_ajax_nopriv_webkits_user_activation', 'webkits_user_activation');
add_action('wp_ajax_webkits_user_activation', 'webkits_user_activation');


add_action('wp_ajax_nopriv_webkits_login', 'webkits_login');
add_action('wp_ajax_webkits_login', 'webkits_login');

add_action('wp_ajax_nopriv_webkits_forgot', 'webkits_forgot');
add_action('wp_ajax_webkits_forgot', 'webkits_forgot');

add_action('wp_ajax_nopriv_webkits_get_listing', 'webkits_get_listing');

add_action('wp_ajax_webkits_get_listing', 'webkits_get_listing');  // POST FOR LISTINGS ??

add_action('wp_ajax_nopriv_webkits_get_offices', 'webkits_get_offices'); // Get Offices

add_action('wp_ajax_webkits_get_offices', 'webkits_get_offices');  // Get Offices

add_action('wp_ajax_nopriv_webkits_get_slisting', 'webkits_get_slisting');  //Show's a Second Feed

add_action('wp_ajax_webkits_get_slisting', 'webkits_get_slisting'); //Show's a Second Feed



add_action('wp_ajax_nopriv_webkits_get_agent_listing', 'webkits_get_agent_listing');  // Get Agent's Listing

add_action('wp_ajax_webkits_get_agent_listing', 'webkits_get_agent_listing'); // Get Agent's Listing

add_action('wp_ajax_nopriv_webkits_get_agent', 'webkits_get_agent'); // Get Agent Detail

add_action('wp_ajax_webkits_get_agent', 'webkits_get_agent'); // Get Agent Detail

add_action('wp_ajax_webkits_accept_crea', 'webkits_accept_crea'); //Accept Crea

add_action('wp_ajax_nopriv_webkits_accept_crea', 'webkits_accept_crea'); //Accept Crea



add_action('wp_ajax_webkits_get_markers', 'webkits_get_markers'); //

add_action('wp_ajax_nopriv_webkits_get_markers', 'webkits_get_markers'); //G

add_action('wp_ajax_webkits_get_sold_markers', 'webkits_get_sold_markers'); //

add_action('wp_ajax_nopriv_webkits_get_sold_markers', 'webkits_get_sold_markers'); //Get Markers for Map with Search

add_action('wp_ajax_webkits_get_addresses', 'webkits_get_addresses');

add_action('wp_ajax_nopriv_webkits_get_addresses', 'webkits_get_addresses');

add_action( 'query_vars', 'wpse_query_vars' );
add_action( 'query_vars', 'account_query_vars' );
add_action( 'parse_request', 'wpse_parse_request' );
/*add_action('upgrader_process_complete', 'webkit_plugin_update', 10, 2);


function webkit_plugin_update($upgrader_object, $options)
{


		$current_plugin_path_name = plugin_basename(__FILE__);
		global $wpdb;
		if($options['action'] == 'update' && $options['type'] == 'plugin')
		{
			foreach($options['plugins'] as $each_plugin)
			{
				if($each_plugin == $current_plugin_path_name)
				{
					$current_user = wp_get_current_user();

					if(null === $wpdb->get_row("SELECT post_name,post_title FROM {$wpdb->prefix}posts WHERE post_name = 'sold-listings' OR post_title = 'Sold Listings'", 'ARRAY_A'))
					{
						$page = array(

							'post_title' => __('Sold Listings'),

							'post_status' => 'publish',

							'post_author' => $current_user->ID,

							'post_type' => 'page',

							'post_name' => 'sold-listings',

							'post_content' => '<div class="brz-root__container brz-reset-all"><section id="eqwfrqgodp" class="brz-section css-1c2016y" data-uid="eqwfrqgodp"><div class="brz-section__items"><div class="brz-section__content" data-custom-id="ksbicbtrhr"><div class="brz-bg css-1sqhm9n"><div class="brz-bg-media"><div class="brz-bg-color"></div></div><div class="brz-bg-content"><div class="brz-container__wrap css-16e3gxi"><div class="brz-container css-1ptl1a3"><div class="brz-row__container" data-custom-id="lsesswgvzc"><div class="brz-bg brz-d-xs-flex brz-flex-xs-wrap css-z34uv"><div class="brz-bg-media"><div class="brz-bg-color"></div></div><div class="brz-bg-content"><div class="brz-row css-18qg7sn"><div class="brz-columns css-z4jmud" data-custom-id="szmeyuypyh"><div class="brz-bg brz-d-xs-flex css-1f2z3"><div class="brz-bg-media"><div class="brz-bg-color"></div></div><div class="brz-bg-content"><div class="brz-wrapper css-6fvry1"><div class="brz-d-xs-flex css-laz546"><div class="brz-embed-code css-1t99mi5" data-custom-id="nmxjjqtepo"><div class="">[listings section="sold-search-form"][listings section="sold-listings"]</div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></section></div>',

						);
						$id =  wp_insert_post($page);

						$option = get_option('webkits');
						$post_id = $option['webkits_listings_page'];
						$post = get_post( $post_id );

						/*
						 * duplicate all post meta just in two SQL queries
						 */
/*$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
if (count($post_meta_infos)!=0) {
	$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
	foreach ($post_meta_infos as $meta_info)
	{

		$meta_key = $meta_info->meta_key;
		if($meta_info->meta_key == 'brizy') {
			$b =array();
			$b['brizy-post']['compiled_html'] = '<!DOCTYPE html><html lang="en"><head></head><body><div class="brz-root__container brz-reset-all"><section id="eqwfrqgodp" class="brz-section css-1c2016y" data-uid="eqwfrqgodp"><div class="brz-section__items"><div class="brz-section__content" data-custom-id="ksbicbtrhr"><div class="brz-bg css-1sqhm9n"><div class="brz-bg-media"><div class="brz-bg-color"></div></div><div class="brz-bg-content"><div class="brz-container__wrap css-16e3gxi"><div class="brz-container css-1ptl1a3"><div class="brz-row__container" data-custom-id="lsesswgvzc"><div class="brz-bg brz-d-xs-flex brz-flex-xs-wrap css-z34uv"><div class="brz-bg-media"><div class="brz-bg-color"></div></div><div class="brz-bg-content"><div class="brz-row css-18qg7sn"><div class="brz-columns css-z4jmud" data-custom-id="szmeyuypyh"><div class="brz-bg brz-d-xs-flex css-1f2z3"><div class="brz-bg-media"><div class="brz-bg-color"></div></div><div class="brz-bg-content"><div class="brz-wrapper css-6fvry1"><div class="brz-d-xs-flex css-laz546"><div class="brz-embed-code css-1t99mi5" data-custom-id="nmxjjqtepo"><div class="">[listings section="sold-search-form"][listings section="sold-listings"]</div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></section></div></body></html>';
			$val = serialize($b);


			$meta_value = addslashes($val);
		}
		elseif($meta_info->meta_key == 'brizy_post_uid')
		{

			$meta_value = addslashes(md5($id.time()));
		}
		elseif($meta_info->meta_key == 'brizy-bk-Brizy_Admin_Migrations_ShortcodesMobileOneMigration-1.0.39')
		{
			$meta_value = '';
		}
		else{

			$meta_value = addslashes($meta_info->meta_value);
		}

		$sql_query_sel[]= "SELECT $id, '$meta_key', '$meta_value'";
	}
	$sql_query.= implode(" UNION ALL ", $sql_query_sel);
	$wpdb->query($sql_query);
}

if(empty($option['webkits_sold_listings_page']))
{
	$option['webkits_sold_listings_page'] = $id;
	update_option('webkits', $option);
}

}
if(null === $wpdb->get_row("SELECT post_name,post_title FROM {$wpdb->prefix}posts WHERE post_name = 'change-password' OR post_title = 'Change Password'", 'ARRAY_A'))
{
$page = array(

	'post_title' => __('Change Password'),

	'post_status' => 'publish',

	'post_author' => $current_user->ID,

	'post_type' => 'page',

	'post_name' => 'change-password',

	'post_content' => '<div class="brz-root__container brz-reset-all"><section id="eqwfrqgodp" class="brz-section css-1c2016y" data-uid="eqwfrqgodp"><div class="brz-section__items"><div class="brz-section__content" data-custom-id="ksbicbtrhr"><div class="brz-bg css-1sqhm9n"><div class="brz-bg-media"><div class="brz-bg-color"></div></div><div class="brz-bg-content"><div class="brz-container__wrap css-16e3gxi"><div class="brz-container css-1ptl1a3"><div class="brz-row__container" data-custom-id="lsesswgvzc"><div class="brz-bg brz-d-xs-flex brz-flex-xs-wrap css-z34uv"><div class="brz-bg-media"><div class="brz-bg-color"></div></div><div class="brz-bg-content"><div class="brz-row css-18qg7sn"><div class="brz-columns css-z4jmud" data-custom-id="szmeyuypyh"><div class="brz-bg brz-d-xs-flex css-1f2z3"><div class="brz-bg-media"><div class="brz-bg-color"></div></div><div class="brz-bg-content"><div class="brz-wrapper css-6fvry1"><div class="brz-d-xs-flex css-laz546"><div class="brz-embed-code css-1t99mi5" data-custom-id="nmxjjqtepo"><div class="">[user section="change-password"]</div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></section></div>',

);
wp_insert_post($page);
}

if(null === $wpdb->get_row("SELECT post_name,post_title FROM {$wpdb->prefix}posts WHERE post_name = 'edit-profile' OR post_title = 'Edit Profile'", 'ARRAY_A'))
{

$page = array(

	'post_title' => __('Edit Profile'),

	'post_status' => 'publish',

	'post_name' => 'edit-profile',

	'post_author' => $current_user->ID,

	'post_type' => 'page',

	'post_content' => '<div class="brz-root__container brz-reset-all"><section id="eqwfrqgodp" class="brz-section css-1c2016y" data-uid="eqwfrqgodp"><div class="brz-section__items"><div class="brz-section__content" data-custom-id="ksbicbtrhr"><div class="brz-bg css-1sqhm9n"><div class="brz-bg-media"><div class="brz-bg-color"></div></div><div class="brz-bg-content"><div class="brz-container__wrap css-16e3gxi"><div class="brz-container css-1ptl1a3"><div class="brz-row__container" data-custom-id="lsesswgvzc"><div class="brz-bg brz-d-xs-flex brz-flex-xs-wrap css-z34uv"><div class="brz-bg-media"><div class="brz-bg-color"></div></div><div class="brz-bg-content"><div class="brz-row css-18qg7sn"><div class="brz-columns css-z4jmud" data-custom-id="szmeyuypyh"><div class="brz-bg brz-d-xs-flex css-1f2z3"><div class="brz-bg-media"><div class="brz-bg-color"></div></div><div class="brz-bg-content"><div class="brz-wrapper css-6fvry1"><div class="brz-d-xs-flex css-laz546"><div class="brz-embed-code css-1t99mi5" data-custom-id="nmxjjqtepo"><div class="">[user section="edit-profile"]</div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></section></div></body>',


);
wp_insert_post($page);
}

}

}
}

}
*/

function set_content_type(){
	return 'text/html';
}
function webkits_listing_rewrite()

{

	global $wp, $wp_rewrite, $dbHost;

	$options = get_option('webkits');

	$page    = $options['webkits_listing_page'];

	$wp->add_query_var('l');
	$wp->add_query_var('Action');




	//add_rewrite_rule('property/([0-9]+)-(.*)', 'index.php?page_id='.$page.'&l=$matches[1]', 'top');
	add_rewrite_rule('property/([0-9]+)/(.*)', 'index.php?page_id='.$page.'&l=$matches[1]', 'top');

	$wp_rewrite->flush_rules(true);

}





/*AJAX*/

function webkits_get_slisting()

{

	global $dbHost;

	$options = get_option('webkits');



	if(isset($options['webkits_site_type']) && $options['webkits_site_type'] == 'both')

	{

		$link          = "listing/".$options['webkits_site_type']."/".$options['webkits_list_id'];

		$json_feed_url = $dbHost.$link;

		global $crawler;

		if ($crawler )

		{

			return null;

		}

		$json          = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));

		echo $json['body'];

	}

	else

	{

		if(!isset($options['webkits_ssite_type']) || $options['webkits_ssite_type'] == '')

			$options['webkits_ssite_type'] = $options['webkits_site_type'];

		if(!isset($options['webkits_slist_id']) || $options['webkits_slist_id'] == '')

			$options['webkits_slist_id'] = $options['webkits_list_id'];

		$link          = "listing/".$options['webkits_ssite_type']."/".$options['webkits_slist_id'];

		$json_feed_url = $dbHost.$link;

		global $crawler;

		if ($crawler )

		{

			return null;

		}

		$json          = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));

		echo $json['body'];

	}

	die();

}



if(!isset($_POST['input_main']) && isset($_SESSION['webkit-search']))

{

	$_POST = $_SESSION['webkit-search'];

}
if(!isset($_POST['input_main']) && isset($_SESSION['webkit-sold-search']))

{

	$_POST = $_SESSION['webkit-sold-search'];

}



// AJAX

function webkits_get_markers()

{

	global $dbHost;

	session_start();

	if(isset($_SESSION['webkit-search']))

	{

		$_POST = $_SESSION['webkit-search'];

	}

	$options          = get_option('webkits');

	$link             = "ShowMarkers/".$options['webkits_site_type']."/".$options['webkits_list_id'];

	$json_feed_url    = $dbHost.$link;

	$_POST['data']    = $_POST;

	//$_POST['perpage'] = $listingPerPage;

	global $crawler;

	if ($crawler )

	{

		return null;

	}

	$json             = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));

	echo $json['body'];

	die();

}
function webkits_get_sold_markers()

{
	global $dbHost,$_SESSION;

	session_start();

	if(isset($_SESSION['webkit-sold-search']))

	{

		$_POST = $_SESSION['webkit-sold-search'];

	}


	$options = get_option('webkits');
	if(isset($options['webkits_oreb_id']) && $options['webkits_oreb_id'] != '')
	{
		$_POST['agent_id'] = $options['webkits_oreb_id'];
	}

	$link             = "ShowSoldMarkers/";

	$json_feed_url = $dbHost.$link;

	$_POST['data'] = $_POST;

	//$_POST['perpage'] = $listingPerPage;

	global $crawler;

	if($crawler)

	{

		return null;

	}

	$json = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));

	echo $json['body'];

	die();



}

// AJAX

function webkits_get_listing()

{

	global $dbHost;

	$options       = get_option('webkits');

	$link          = "listing/".$options['webkits_site_type']."/".$options['webkits_list_id'];

	$json_feed_url = $dbHost.$link;

	global $crawler;

	if ($crawler )

	{

		return null;

	}

	$json          = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));

	echo $json['body'];

	die();

}



// AJAX

function webkits_get_offices()

{

	global $dbHost;

	$options       = get_option('webkits');

	$link          = "SnapShot/".$options['webkits_site_type']."/".$options['webkits_list_id'];

	$json_feed_url = $dbHost.$link;

	global $crawler;

	if ($crawler )

	{

		return null;

	}

	$json          = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));

	echo $json['body'];

	die();

}



// AJAX

function webkits_get_agent_listing()

{

	global $dbHost;

	$options       = get_option('webkits');

	$link          = "listing/agent/".$_POST['data'];

	$json_feed_url = $dbHost.$link;

	global $crawler;

	if ($crawler )

	{

		return null;

	}

	$json          = wp_remote_post($json_feed_url, array("body" => array("p" => "")));

	echo $json['body'];

	die();

}



// AJAX

function webkits_get_agent()

{

	global $dbHost;

	$options       = get_option('webkits');

	$link          = "agents/".$options['webkits_list_id'];

	$json_feed_url = $dbHost.$link;

	global $crawler;

	if ($crawler )

	{

		return null;

	}

	$json          = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));

	echo $json['body'];

	die();

}
function webkits_get_addresses()
{
	global $dbHost;
	$options = get_option('webkits');
	$link          = "address/";

	$json_feed_url = $dbHost.$link;

	global $crawler;

	if ($crawler )

	{

		return null;

	}

	$json          = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));
	//echo "<pre>";print_r($json);die;
	wp_send_json( json_decode($json['body']) );
}


function webkits_accept_crea()

{

	global $dbHost;

	session_start();

	echo($_SESSION['webkits-accept']);

	$options = get_option('webkits');

	if((isset($_POST['data']) && $_POST['data'] == 1) || (isset($options['webkits_agree_msg']) && $options['webkits_agree_msg'] == '0'))

		$_SESSION['webkits-accept'] = 1;

	echo($_SESSION['webkits-accept']);

	die();

}





//Filter

function webkits_title($title)

{

	global $wp;

	global $dbHost;

	if(isset($wp->query_vars['l']))

	{

		if(!session_id())

		{

			session_start();

			if($_SESSION['listings']->ID == $wp->query_vars['l'])

				unset($_SESSION['listings']);

		}

		if(!isset($_SESSION['listings']) || $_SESSION['listings']->content->ListingKey != $wp->query_vars['l'])

		{

			$options              = get_option('webkits');

			$link                 = "listing/".$options['webkits_site_type']."/".$options['webkits_list_id']."/".$wp->query_vars['l'];

			$json_feed_url        = $dbHost.$link;

			$args                 = array('timeout' => 120);

			$json_feed            = wp_remote_get($json_feed_url, $args);
			//			echo "<pre>";print_r($json_feed);die;
			$_SESSION['listings'] = json_decode($json_feed['body']);

			remove_all_actions('wpseo_head');

			remove_all_actions('wpseo_opengraph');

			$listing = $_SESSION['listings'];



			return strip_tags($listing->basic->UnparsedAddress." - ".$listing->basic->City." - ".$listing->basic->StateOrProvince." &raquo; ".$listing->content->MLS." &raquo; ").get_bloginfo();



		}

	}

	else

		return get_the_title();

}


function remove_og()
{
	global $wp;
	if(isset($_GET['l']) || isset($wp->query_vars['l']))
	{
		remove_all_actions( 'rank_math/opengraph/facebook' );
		remove_all_actions( 'rank_math/opengraph/twitter' );
	}
}
function remove_seo_og($type)
{
	global $wp;
	if(isset($_GET['l']) || isset($wp->query_vars['l']))
	{
		return false;
	}
	else{
	    return $type;
    }
}
//ACTION

function webkits_og_tags()

{

	global $wp;

	global $dbHost;

	$options = get_option('webkits');



	if(isset($_GET['l']) || isset($wp->query_vars['l']))

	{



		$_GET['l'] = isset($_GET['l'])?$_GET['l']:$wp->query_vars['l'];



		if(isset($_GET['l']) && is_numeric($_GET['l']))

		{

			if(!isset($_SESSION['listings']) || $_SESSION['listings']->content->ListingKey != $_GET['l'])

			{

				$options = get_option('webkits');

				$link    = "listing/".$options['webkits_site_type']."/".$options['webkits_list_id']."/".$_GET['l'];



				$json_feed_url = $dbHost.$link;



				$args          = array('timeout' => 120);

				$json_feed            = wp_remote_get($json_feed_url, $args);

				$_SESSION['listings'] = json_decode($json_feed['body']);



			}

			$listing = $_SESSION['listings'];


			?>

			<?php $pos=strpos($listing->content->Remarks, ' ', 160);
			$desc = substr($listing->content->Remarks,0,$pos ); ?>
            <meta name="description"  content="<?php echo $desc.'...'; ?>"/>
            <link rel="canonical" href="http://<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"] ?>"/>
            <meta property="og:title" content="<?php echo $listing->basic->UnparsedAddress.", ".$listing->basic->City.' - $'.$listing->content->mprice ?>">

            <meta property="og:description"  content="<?php echo $listing->content->Remarks; ?>">

            <meta property="og:type" content="website">

            <meta property="og:url" content="http://<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"] ?>">

            <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>">

			<?php

			if(is_array($listing->info->Photo->PropertyPhoto) && isset($listing->info->Photo->PropertyPhoto[0]->LargePhotoURL) && $listing->info->Photo->PropertyPhoto[0]->LargePhotoURL != '')
			{
				$photo = $listing->info->Photo->PropertyPhoto[0]->LargePhotoURL;
			}
            elseif (is_array($listing->info->Photo->PropertyPhoto) && isset($listing->info->Photo->PropertyPhoto->LargePhotoURL) && $listing->info->Photo->PropertyPhoto->LargePhotoURL != '')
			{
				$photo = $listing->info->Photo->PropertyPhoto->LargePhotoURL;
			}
			else{
				$photo = 'https://curiouscloud.ca/assets/images/no-photo.png';
			}
			?>


            <meta property="og:image" content="<?php echo $photo; ?>">

            <meta property="og:image:width" content="<?php echo $listing->content->imagewidth; ?>">

            <meta property="og:image:height" content="<?php echo $listing->content->imageheight; ?>">
            <meta property="og:image:alt" content="<?php echo $listing->basic->UnparsedAddress; ?>"/>
			<?php



		}

	}

}



//FILTER

function add_og_xml_ns($content)

{

	return ' xmlns:og="http://ogp.me/ns#" '.$content;

}



//FILTER

function add_fb_xml_ns($content)

{

	return ' xmlns:fb="https://www.facebook.com/2008/fbml" '.$content;

}



$listing = [];

//FILTER

function custom_set_email_value($recipients, $values, $form_id, $args)

{

	global $listing;

	if($args['form']->form_key == 'teamlead')

	{

		session_start();

		$listing = $_SESSION['listings'];

		unset($_SESSION['listings']);

		$recipients = $listing->content->Email;

	}



	return $recipients;

}



//FILTER

function add_email_header($message, $args)

{

	global $listing;

	if($args['form']->form_key == 'teamlead')

	{

		$l = $listing->basic;

		if($args['plain_text'] != 1)

		{

			$email_header

				= '

           '.$l->UnparsedAddress.'

<br>

'.$l->City.'<br>

'.$l->StateOrProvince.' <br>

'.$l->PostalCode.'

<br>

'.substr($l->PostalCode, 0, 3).'

			<br>

'.$listing->info->ListingID.'

			<br>



'.$l->Type.'

		   <br>

teamrealty.ca



			';



		}

		else

		{

			$email_header = 'Street Address: '.$l->UnparsedAddress." \r\n ".'City: '.$l->City." \r\n ".'Province: '.$l->StateOrProvince." \r\n ".'Postal: '.$l->PostalCode.' - '.substr($l->PostalCode, 0, 3)." \r\n";

			$email_header .= "MLS: ".$listing->info->ListingID." \r\n ".'Property Type: '.$l->Type." \r\n\r\n\r\n";

		}

		$message = $email_header.$message;

	}



	return $message;

}





//ANALYTICS FUNCTION

function gen_uuid()

{

	return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));

}



//SHORTCODE

function webkits_details_shortcode($atts, $content = null)

{

	global $wp;

	$options   = get_option('webkits');

	$_GET['l'] = $wp->query_vars['l'];

	wp_enqueue_script('jquery-v', plugin_dir_url(__FILE__).('public/js/jquery-validation-1.16.0/dist/jquery.validate.js'));
	wp_enqueue_script('login', plugin_dir_url(__FILE__).('public/js/login.js'));
	//if(isset($_GET['ac']) && $_GET['ac'] == 0) unset($_SESSION['webkits-accept']);



	if(!isset($_GET['l']) || !is_numeric($_GET['l']))

	{

		if(!current_user_can('manage_options'))

			die();

		else

		{



			$listing                   = new stdClass();



			$listing->content->address = '<span style="display:block;margin-bottom:0px;">777 King Street</span><small>Ottawa, Ontario V0E1V3</small>';

			$listing->latitude         = 45.4215;

			$listing->longitude        = -75.6972;

			$listing->content->tags    = ' <div  class="col-md-12"><h2><span class="label label-info" style="">5 Bedroom</span>          <span class="label label-info">2 Bathroom</span>      </h2><h3>          <span class="label label-info label-sm label-warning">Garage</span>      </h3></div>';

			$listing->content->price   = '$1,000,000';

			$listing->content->MLS     = 'MLS&reg; 1337';

			$listing->content->Remarks = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum';

			$listing->content->BuildingInfo

				= '<table class="table table-hover table-bordered"><tbody><tr><td>

          <strong> Bathroom Total</strong> </td> <td class="text-right"> 2       </td></tr>           <tr><td>

          <strong> Bedrooms Total</strong></td><td class="text-right">  5     </td></tr>           <tr>

        <td><strong> Year Built</strong></td><td class="text-right"> 1968        </td>

      </tr>           <tr> <td><strong> Flooring Type</strong> </td>

        <td class="text-right">  Hardwood, Carpeted, Linoleum        </td></tr>           <tr>

        <td> <strong> Half Bathrooms Total</strong> </td> <td class="text-right"> 0     </td></tr>           <tr><td><strong> Heating Type</strong></td>

        <td class="text-right">

          Forced air      </td>

      </tr>               <tr>

            <td>

              <strong> Heating Fuel</strong>

            </td>

            <td class="text-right">

              Natural gas     </td>

          </tr>           <tr>

        <td>

          <strong> Type</strong>

        </td>

        <td class="text-right">

          House       </td>

      </tr>





            <tr>

        <td>

          <strong> Utility Water</strong>

        </td>

        <td class="text-right">

          Municipal Water       </td>

      </tr>





  </tbody>

</table>';



			$listing->content->OpenHouse

				= "<span class='openhousebanner'>Open House: 01/01/1970 2:00:00 PM to 01/01/1970 4:00:00 PM

</span> ";

			$listing->content->image = '<img class="img-responsive" src="https://curiouscloud.ca/assets/images/no-photo.png" />';

			$listing->content->FloorInfo

				= "<table class='table table-striped table-bordered grid2'>

  <tbody>

<tr><td>Living room</td><td>Main level</td><td>24 ft ,2 in x 15 ft</td></tr><tr><td>Dining room</td><td>Main level</td><td>15 ft x 12 ft ,10 in</td></tr><tr><td>Kitchen</td><td>Main level</td><td>19 ft x 10 ft ,10 in</td></tr><tr><td>Family room</td><td>Main level</td><td>16 ft ,9 in x 14 ft ,8 in</td></tr><tr><td>Den</td><td>Main level</td><td>11 ft ,8 in x 11 ft ,7 in</td></tr><tr><td>Laundry room</td><td>Main level</td><td>11 ft ,7 in x 7 ft ,1 in</td></tr><tr><td>Partial bathroom</td><td>Main level</td><td>8 ft ,2 in x 5 ft</td></tr><tr><td>Foyer</td><td>Main level</td><td>9 ft ,8 in x 8 ft ,6 in</td></tr><tr><td>Eating area</td><td>Main level</td><td>13 ft ,3 in x 10 ft ,6 in</td></tr><tr><td>Master bedroom</td><td>Second level</td><td>20 ft ,9 in x 14 ft ,3 in</td></tr><tr><td>Bedroom 2</td><td>Second level</td><td>13 ft ,11 in x 9 ft ,9 in</td></tr><tr><td>Bedroom 3</td><td>Second level</td><td>13 ft x 11 ft ,3 in</td></tr><tr><td>Bedroom 4</td><td>Second level</td><td>14 ft ,7 in x 10 ft ,7 in</td></tr><tr><td>Full bathroom</td><td>Second level</td><td>9 ft ,9 in x 8 ft ,10 in</td></tr><tr><td>Family room</td><td>Second level</td><td>24 ft x 14 ft ,10 in</td></tr><tr><td>Games room</td><td>Second level</td><td>14 ft ,10 in x 12 ft ,11 in</td></tr><tr><td>5pc Ensuite bath</td><td>Second level</td><td>17 ft x 13 ft ,7 in</td></tr><tr><td>Other</td><td>Second level</td><td>6 ft x 3 ft ,10 in</td></tr><tr><td>Bedroom</td><td>Basement</td><td>22 ft ,9 in x 13 ft</td></tr><tr><td>Recreation room</td><td>Basement</td><td>35 ft ,10 in x 15 ft ,2 in</td></tr><tr><td>3pc Bathroom</td><td>Basement</td><td>9 ft x 5 ft ,3 in</td></tr></tbody></table>";

		}



	}

	else

	{

		$listing = $_SESSION['listings'];



	}



	$args = (shortcode_atts(array('section' => "address", 'col' => "2", 'crea-popup' => 1), $atts));





	ob_start();



	//echo "<pre>";print_r($listing->content);die;

	switch($args['section'])

	{

		case 'address':

			if(isset($_SESSION['listings']))

			{

				if(!is_dynamic_sidebar())
				{
					add_filter('the_title', 'some_callback');
				}

				if(!function_exists('some_callback'))

				{

					function some_callback($data)

					{


						$listing = $_SESSION['listings'];



						return $listing->content->address." &raquo; ".$listing->content->MLS;

					}

				}

			}

			echo $listing->content->address;

			if(isset($options['webkits_crea_clientid']) && $options['webkits_crea_clientid'] != '')
			{

				if(!isset($_SESSION['guid']))

					$_SESSION['guid'] = gen_uuid();

				$analytics = "http://analytics.crea.ca/LogEvents.svc/LogEvents?ListingID={$listing->ID}&DestinationID={$options['webkits_crea_clientid']}&EventType=view&UUID={$_SESSION['guid']}&IP={$_SERVER['REMOTE_ADDR']}";

				$json      = wp_remote_get($analytics, array());


			}
			if($listing->info->Status == 'Sold')
			{
				include('includes/register-login.php');
			}

			if($args['crea-popup'] == 0 || (isset($_SESSION['webkits-accept']) && $_SESSION['webkits-accept'] == 1))

				break;

			include('inc/agreement.php');

			break;

		case 'price':

			if($listing->content->show_price == 1){
				if($listing->content->Status == 'Sold')
				{
					echo '<p class="price p-w"><span class="text-red">SOLD</span>&nbsp;<span class="sprice">  $'. $listing->content->sprice.'</span></p>';
				}
				else{
					echo '<p class="price">$'.number_format((float) $listing->content->mprice).'</p>';
				}

			}

			break;

		case 'tags':

			echo $listing->content->tags;

			break;

		case 'pictures':

			echo $listing->content->pictures;

			break;

		case 'remarks':

			echo $listing->content->Remarks;

			break;

		case 'BuildingInfo':

			echo $listing->content->BuildingInfo;

			break;

		case 'FloorInfo':

			echo $listing->content->FloorInfo;

			break;

		case 'thumbnails':

			echo $listing->content->thumbnails;

			break;

		case 'gallery':

			echo str_replace("#row#", (12 / $args['col']), $listing->content->gallery);

			break;

		case 'image':

			echo $listing->content->image;

			break;

		case 'MLS':

			echo $listing->content->MLS;

			break;

		case 'Agent':

			echo $listing->content->Agent;

			break;

		case 'Links':

			echo $listing->content->Links;

			break;
		case 'media':
			echo $listing->content->Media;
			break;
		case 'livestream':
			echo $listing->content->Live;
			break;
		case 'floorplans':
			echo $listing->content->Floorplans;
			break;
		case 'OpenHouse':

			echo $listing->content->OpenHouse;

			break;

		case "calculator":

			wp_enqueue_script('calculator', plugin_dir_url(__FILE__).'public/js/mortgage.js', '', '', true);

			require("includes/details_mortgage.php");

			break;



		case 'map':

			wp_enqueue_style('map', plugin_dir_url(__FILE__).('public/css/map.css'));

			wp_enqueue_script('mpce-gma-google-maps-api', 'http://maps.google.com/maps/api/js?key=AIzaSyDZ9XDDXc0IBIOPhc3Hw1TaXJEDR2LpU3k', '', '', true);

			wp_enqueue_script('gmap', plugin_dir_url(__FILE__).'public/js/map.js', array('jquery'), '', true);

			wp_enqueue_script('singlemap', plugin_dir_url(__FILE__).'public/js/singlemap.js', array('jquery'), '', true);

			$options['webkits_map_zoom'] = isset($options['webkits_map_zoom'])?$options['webkits_map_zoom']:10;

			if($options['webkits_map_style'] != '')

			{

				echo "<script>zoom = ".$options['webkits_map_zoom'].";lon = ".$listing->longitude.";lat = ".$listing->latitude.";styler = ".str_replace('\"', '"', $options['webkits_map_style'])."</script>";

			}

			else

			{

				echo "<script>zoom = ".$options['webkits_map_zoom'].";lon = ".$listing->longitude.";lat = ".$listing->latitude.";styler = '';</script>";

			}

			echo "<script>single = true;</script>";

			echo "<script>noCluster = true;</script>";

			require("includes/listing_map.php");
			//require("includes/listing_local_logic_map.php");



			break;

		case 'locallogicmap':
			global $dbHost;
			$link          = "creb/".$options['webkits_site_type']."/".$options['webkits_list_id'];
			$ll_neighborhood_apikey     = (isset($options['webkits_ll_neighborhood_apikey']) && !empty($options['webkits_ll_neighborhood_apikey']))? $options['webkits_ll_neighborhood_apikey']:'';

			$json_feed_url = $dbHost.$link;

			global $crawler;

			if ($crawler )

			{

				return null;

			}

			$json          = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));

			$result = json_decode($json['body']);

			if($result->creb == true && $listing->latitude != '' && $listing->longitude != '')
			{
				wp_enqueue_script('chart', plugin_dir_url(__FILE__).'public/js/chart.js');
				wp_enqueue_script('chart', plugin_dir_url(__FILE__).'public/js/Chart.bundle.min.js');
				$ll_apikey     = (isset($options['webkits_ll_apikey']) && !empty($options['webkits_ll_apikey']))? $options['webkits_ll_apikey']:'';
				echo "<script>lon = ".$listing->longitude.";lat = ".$listing->latitude.";</script>";
				if(isset($ll_neighborhood_apikey) && $ll_neighborhood_apikey != '')
				{
					$ch = curl_init();

					$key = "X-API-KEY:".$ll_neighborhood_apikey;

					$headers = array($key,//yMZE4ZYXUgTn36yEys3O4f94NlJEvqF2xM3NvOYb
					);
					$url     = 'https://api.locallogic.co/v1/demographics/?lat='.$listing->latitude.'&lng='.$listing->longitude.'&local=en';

					//$url = 'https://api.locallogic.co/v1/demographics/?lat=45.324767&lng=-75.9324272';
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
					$result    = curl_exec($ch);
					$arrResult = json_decode($result);

					if($arrResult->data->attributes)
					{
						require("includes/listing_ll_demographic.php");
					}
					//require("includes/listing_ll_demographic.php");
				}
				if($ll_apikey != '' )
				{
					require("includes/listing_local_logic_map.php");
				}

			}

			break;

	}



	$content = ob_get_clean();



	return $content;

}





function webkits_agent_shortcode($atts, $content = null)

{

	global $dbHost;

	$options = get_option('webkits');

	if(!isset($_SESSION['agent']) || $_SESSION['agent']->agent->aid != $_GET['l'])

	{

		$options       = get_option('webkits');

		$link          = "agents/".$options['webkits_list_id']."/".$_GET['l'];

		$json_feed_url = $dbHost.$link;



		$args = array('timeout' => 120);

		global $crawler;

		if ($crawler )

		{

			return null;

		}

		$json_feed = wp_remote_post($json_feed_url, $args);


		$i = 1;



		$_SESSION['agent'] = json_decode($json_feed['body']);

	}



	$agent = $_SESSION['agent'];



	$args = (shortcode_atts(array('section' => "mini",), $atts));


	if($args['section'] == "listings")

	{

		wp_enqueue_style('map', plugin_dir_url(__FILE__).('public/css/map.css'));

		wp_enqueue_script('mpce-gma-google-maps-api', 'http://maps.google.com/maps/api/js?key=AIzaSyDZ9XDDXc0IBIOPhc3Hw1TaXJEDR2LpU3k', '', '', true);

		wp_enqueue_script('gmap', plugin_dir_url(__FILE__).'public/js/map.js', array('jquery'), '', true);

		wp_enqueue_script('cluster', plugin_dir_url(__FILE__).'public/js/marker.js', array('jquery'), '', true);

		wp_enqueue_script('listings', plugin_dir_url(__FILE__).'public/js/listings.js', array('jquery'), '', true);

		wp_enqueue_script('masonary', plugin_dir_url(__FILE__).'public/js/masonry.min.js', array('jquery'), '', true);

	}
	if($args['section'] == "image"){

		wp_enqueue_script('fancybox_js', plugin_dir_url(__FILE__).'public/js/fancybox-2.1.7/source/jquery.fancybox.js', array('jquery'), '', false);
		wp_enqueue_style('fancybox_css', plugin_dir_url(__FILE__).'public/js/fancybox-2.1.7/source/jquery.fancybox.css', '', '', false);

		wp_enqueue_style('fancybox_btn_css', plugin_dir_url(__FILE__).'public/js/fancybox-2.1.7/source/helpers/jquery.fancybox-buttons.css', '', '', false);
		wp_enqueue_script('fancybox_btn', plugin_dir_url(__FILE__).'public/js/fancybox-2.1.7/source/helpers/jquery.fancybox-buttons.js', array('jquery'), '', false);
		wp_enqueue_script('fancybox_mdi', plugin_dir_url(__FILE__).'public/js/fancybox-2.1.7/source/helpers/jquery.fancybox-media.js', array('jquery'), '', false);

	}



	ob_start();

	$newMini = str_replace('<a ', '<a target="_blank" ', $agent->agent->list);

	switch($args['section'])

	{

		case 'mini':

			echo $newMini;

			break;

		case 'name':

			echo $agent->agent->name;

			break;

		case 'bio':

			echo $agent->agent->bio;

			break;

		case 'awards':

			echo $agent->agent->awards;

			break;

		case 'image':
			include("includes/agent_photo.php");
			break;

		case 'social':

			echo $agent->agent->social;

			break;

		case 'testimonial':

			echo $agent->agent->testimonial;

			break;

		case 'office':

			echo $agent->agent->officeInfo;

			break;

		case 'listings':

			//unset($_POST['search']);

			unset($_SESSION['webkit-search']);



			$listingPerPage = $options['webkits_listing_perpage'];

			$listingpage    = get_post($options['webkits_listing_page'])->guid."&l=";



			$hideAgent = isset($options['webkits_hide_agents'])?$options['webkits_hide_agents']:0;

			$bcAgent   = isset($options['webkits_bc_agent'])?$options['webkits_bc_agent']:0;



			if(isset($_GET['listing-page']) && is_numeric($_GET['listing-page']))

			{

				$_POST['offset'] = $listingPerPage * ($_GET['listing-page'] - 1);



				$CurrentPage = $_GET['listing-page'];

			}

			else $CurrentPage = 1;





			if(isset($_POST['search']))

			{

				unset($_POST['search']);

				$CurrentPage               = 1;

				$_POST['offset']           = 0;

				$_SESSION['webkit-search'] = $_POST;

				header('Location: '.$_SERVER['REQUEST_URI']);

			}



			$_POST['commercial'] = 1;

			$_POST['lots']       = 1;





			if(!isset($_POST['input_main']) && isset($_SESSION['webkit-search']))

				$_POST = $_SESSION['webkit-search'];

			$link             = "ShowListings/agent/".$agent->agent->aid;

			$json_feed_url    = $dbHost.$link;


			$_POST['data']    = $_POST;

			$_POST['perpage'] = $listingPerPage;

			global $crawler;

			if ($crawler )

			{

				return null;

			}

			$_POST['site_type']        = $options['webkits_ssite_type'];
			$_POST['site_id']          = $options['webkits_slist_id'];
			$json     = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));

			$listings = json_decode($json['body']);



			$webkitsIgnore = true;

			require("inc/listing_page.php");

			break;

	}





	$content = ob_get_clean();



	return $content;



}



//ACTION - ADMIN MENU

function webkits_options_menu()

{

	add_options_page("Webkits Management", "WebKits Options", "manage_options", "webkits-options", "webkits_options");

}



//OPTION MENU

function webkits_options()

{

	if(!current_user_can('manage_options'))

	{

		wp_die("sorry");

	}

	if(isset($_POST['webkits_form_submitted']))

	{


		$hidden_field = esc_html($_POST['webkits_form_submitted']);

		if($hidden_field == 'Y')

		{

			$options['webkits_site_type']        = esc_html($_POST['webkits_site_type']);

			$options['webkits_list_id']          = esc_html(str_replace(",", "|", $_POST['webkits_list_id']));
			$options['webkits_oreb_id']          = esc_html(str_replace(",", "|", $_POST['webkits_oreb_id']));

			$options['webkits_crea_clientid']    = trim(esc_html($_POST['webkits_crea_clientid']));

			$options['webkits_ssite_type']       = esc_html($_POST['webkits_ssite_type']);

			$options['webkits_slist_id']         = esc_html(str_replace(",", "|", $_POST['webkits_slist_id']));

			$options['webkits_listing_page']     = esc_html($_POST['webkits_listing_page']);
			$options['webkits_listings_page']     = esc_html($_POST['webkits_listings_page']);

			$options['webkits_sold_listings_page']    = esc_html($_POST['webkits_sold_listings_page']);

			$options['webkits_listing_perpage']  = esc_html($_POST['webkits_listing_perpage']);

			$options['webkits_hide_agents']      = esc_html($_POST['webkits_hide_agents']);

			$options['webkits_bc_agent']         = esc_html($_POST['webkits_bc_agent']);

			$options['webkits_agent_page']       = esc_html($_POST['webkits_agent_page']);

			$options['webkits_latlng']           = esc_html($_POST['webkits_latlng']);

			$options['last_updated']             = time();

			$options['webkits_map_style']        = $_POST['webkits_map_style'];

			$options['webkits_zerofall']         = $_POST['webkits_zerofall'];

			$options['webkits_map_zoom']         = $_POST['webkits_map_zoom'];

			$options['webkits_rss_feed']         = $_POST['webkits_rss_feed'];

			$options['webkits_map_zoom2']        = $_POST['webkits_map_zoom2'];

			$options['webkits_agree_msg']        = $_POST['webkits_agree_msg'];

			$options['webkits_feature_template'] = $_POST['webkits_feature_template'];

			$options['webkits_listing_default']  = $_POST['webkits_listing_default'];

			$options['webkits_officemlsid']      = esc_html(str_replace(',', '|', $_POST['webkits_officemlsid']));
			$options['webkits_agentid']          = esc_html(str_replace(',', '|', $_POST['webkits_agentid']));
			$options['webkits_ll_apikey']          =  $_POST['webkits_ll_apikey'];
			$options['webkits_ll_neighborhood_apikey']  =  $_POST['webkits_ll_neighborhood_apikey'];
			$options['webkits_enable_sold']  = $_POST['webkits_enable_sold'];
			$options['webkits_register_email']  = $_POST['webkits_register_email'];

			update_option('webkits', $options);



			if(isset($_POST['webkits_update_feed_now']) && $_POST['webkits_update_feed_now'] == 'Y')

			{

				function_name();

				$update_feed_now_result = 'success';

			}

		}



	}

	$options = get_option('webkits');

	if($options != '')

	{

		$webkits_zerofall      = $options['webkits_zerofall'];

		$webkits_site_type     = $options['webkits_site_type'];

		$webkits_crea_clientid = isset($options['webkits_crea_clientid'])?$options['webkits_crea_clientid']:'';

		$webkits_list_id       = str_replace("|", ",", $options['webkits_list_id']);
		$webkits_oreb_id       = str_replace("|", ",", $options['webkits_oreb_id']);

		$webkits_map_zoom      = (isset($options['webkits_map_zoom']))?$options['webkits_map_zoom']:10;

		$webkits_map_zoom2     = (isset($options['webkits_map_zoom2']))?$options['webkits_map_zoom2']:10;

		$webkits_ssite_type    = $options['webkits_ssite_type'];

		$webkits_slist_id      = str_replace("|", ",", $options['webkits_slist_id']);

		$webkits_latlng        = $options['webkits_latlng'];

		$webkits_listing_page  = $options['webkits_listing_page'];

		$webkits_listings_page = $options['webkits_listings_page'];
		$webkits_sold_listings_page = $options['webkits_sold_listings_page'];

		$webkits_rss_feed      = isset($options['webkits_rss_feed'])?$options['webkits_rss_feed']:'';

		$webkits_hide_agents   = (isset($options['webkits_hide_agents']) && $options['webkits_hide_agents'] == 1)?'checked':"";

		$webkits_bc_agent      = (isset($options['webkits_bc_agent']) && $options['webkits_bc_agent'] == 1)?'checked':"";



		$webkits_listing_perpage  = (isset($options['webkits_listing_perpage']))?$options['webkits_listing_perpage']:50;

		$webkits_agree_msg        = (isset($options['webkits_agree_msg']))?$options['webkits_agree_msg']:'1';

		$webkits_agent_page       = $options['webkits_agent_page'];

		$webkits_map_style        = (isset($options['webkits_map_style']))?str_replace('\"', '"', $options['webkits_map_style']):'[]';

		$webkits_listing_default  = (isset($options['webkits_listing_default']))?str_replace('\"', '"', $options['webkits_listing_default']):"grid";

		$webkits_feature_template = str_replace('\"', '"', $options['webkits_feature_template']);

		$webkits_officemlsid      = (isset($options['webkits_officemlsid']))?str_replace('|', ',', $options['webkits_officemlsid']):'';

		$webkits_agentid          = (isset($options['webkits_agentid']))?str_replace('|', ',', $options['webkits_agentid']):'';
		$webkits_ll_apikey          = (isset($options['webkits_ll_apikey']))?$options['webkits_ll_apikey']:'';
		$webkits_ll_neighborhood_apikey          = (isset($options['webkits_ll_neighborhood_apikey']))?$options['webkits_ll_neighborhood_apikey']:'';
		//	$webkits_enable_sold          = (isset($options['webkits_enable_sold']))?$options['webkits_enable_sold']:'';
		$webkits_enable_sold      = (isset($options['webkits_enable_sold']))?$options['webkits_enable_sold']:"";
		$webkits_register_email      = (isset($options['webkits_register_email']))?$options['webkits_register_email']:"";
	}

	$pages = get_pages();

	require("includes/options-pages.php");

}



//ACTION

function webkits_override()

{

	wp_cache_flush();

}



/*

function webkits_seo_shortcode($atts, $content = null) {

	global $dbHost;

	$options = get_option("webkits");

	$realurl = get_post($options['webkits_listings_page']);

	$args = (shortcode_atts(array(

		'section' => "search"

	), $atts));

	ob_start();

	$link = "seo/" . $options['webkits_site_type'] . "/" . $options['webkits_list_id'];

	$json_feed_url = $dbHost . $link;

	$json = wp_remote_get($json_feed_url, array("body" => array("p" => $_POST)));

	$all = json_decode($json['body']);

	$show = '<meta name="robots" content="noindex, follow">';

	foreach ($all->listing as $s) $show .= "<a href='" . get_site_url() . $s->url . "' title='{$s->r}'>" . $s->r . "</a><br />";

	$realurl2 = get_post($options['webkits_listing_page']);

	echo $show;

	$content .= ob_get_clean();

	return $content;

}*/



//SHORTCODE

function webkits_mainpage_shortcode($atts, $content = null)

{

	global $dbHost;

	if(!wp_script_is("slu", "enqueued"))

	{

		wp_enqueue_style('frame', plugin_dir_url(__FILE__).('public/css/horizontal.css'));



		wp_enqueue_script('slu', plugin_dir_url(__FILE__).'public/js/sly.min.js', array('jquery'), '', true);

		wp_enqueue_script('vendor', plugin_dir_url(__FILE__).'public/js/vendor.js', array('jquery'), '', true);

	}

	else $start = '';



	if(!wp_script_is("3dslide_js", "enqueued"))

	{



		/*wp_deregister_script('jquery-core');

		wp_deregister_script('jquery-migrate');*/



		wp_enqueue_style('font_css', plugin_dir_url(__FILE__).('public/3D_Slider/css/font-awesome/css/font-awesome.css'));

		wp_enqueue_style('prphoto_css', plugin_dir_url(__FILE__).('public/3D_Slider/css/prettyPhoto.css'));

		wp_enqueue_style('flex_css', plugin_dir_url(__FILE__).('public/3D_Slider/css/flexslider.css'));

		wp_enqueue_style('3dslide_css', plugin_dir_url(__FILE__).('public/3D_Slider/css/style.css'));
		wp_enqueue_style('slick', plugin_dir_url(__FILE__).'public/slick/slick.css');

		/*wp_enqueue_style('aud_360p', plugin_dir_url(__FILE__) . ('public/3D_Slider/js/audioplayer/360player.css'));

		wp_enqueue_style('aud_360pv', plugin_dir_url(__FILE__) . ('public/3D_Slider/js/audioplayer/360player-visualization.css'));*/



		//wp_enqueue_script('jquery-core', plugin_dir_url(__FILE__) . 'public/3D_Slider/js/jquery.js', array('jquery'), '', true);
		wp_enqueue_script('slick_js', plugin_dir_url(__FILE__).'public/slick/slick.js');

		wp_enqueue_script('modernizr', plugin_dir_url(__FILE__).'public/3D_Slider/js/modernizr.custom.79639.js', array('jquery'), '2.0', true);

		wp_enqueue_script('prphoto_js', plugin_dir_url(__FILE__).'public/3D_Slider/js/jquery.prettyPhoto.js', array('jquery'), '2.0', true);

		wp_enqueue_script('3dslide_js', plugin_dir_url(__FILE__).'public/3D_Slider/js/all-functions.js', array('jquery'), '2.0', true);

		wp_enqueue_script('class_list', plugin_dir_url(__FILE__).'public/3D_Slider/js/classList.js', array('jquery'), '2.0', true);

		wp_enqueue_script('bespoke', plugin_dir_url(__FILE__).'public/3D_Slider/js/bespoke.js', array('jquery'), '2.0', true);

		wp_enqueue_script('flex_js', plugin_dir_url(__FILE__).'public/3D_Slider/js/jquery.flexslider.js', array('jquery'), '2.0', true);

		/*wp_enqueue_script('aud_ber', plugin_dir_url(__FILE__) . 'public/3D_Slider/js/audioplayer/script/berniecode-animator.js', array('jquery'), '', true);

		wp_enqueue_script('aud_sound', plugin_dir_url(__FILE__) . 'public/3D_Slider/js/audioplayer/script/soundmanager2.js', array('jquery'), '', true);

		wp_enqueue_script('aud_mp3', plugin_dir_url(__FILE__) . 'public/3D_Slider/js/audioplayer/mp3-player-button.js', array('jquery'), '', true);

		wp_enqueue_script('aud_360p', plugin_dir_url(__FILE__) . 'public/3D_Slider/js/audioplayer/script/360player.js', array('jquery'), '', true);*/



		wp_enqueue_script('3d_custom', plugin_dir_url(__FILE__).'public/3D_Slider/js/custom.js', array('jquery'), '1.0', true);



	}

	$scriptUrl = admin_url('admin-ajax.php');

	$options   = get_option("webkits");

	$realurl   = get_post($options['webkits_listings_page']);





	$args = (shortcode_atts(array('section' => "search", 'class' => 'main', 'type' => 'latest'), $atts));





	ob_start();



	switch($args['section'])

	{

		case 'search':

			require("includes/main_search.php");

			break;

		case 'openhouse':

			require("includes/main_openhouse.php");

			break;

		case "calculator":

			wp_enqueue_script('calculator', plugin_dir_url(__FILE__).'public/js/mortgage.js', '', '', true);

			require("includes/details_mortgage.php");

			break;

		case 'slider':

			if($args['type'] == 'random')

				$link = "slider/random/".$options['webkits_site_type']."/".$options['webkits_list_id'];

			else

				$link = "slider/latest/".$options['webkits_site_type']."/".$options['webkits_list_id'];

			//echo $link;die;
			$_POST = array();
			if(isset($atts['from-city']) && $atts['from-city'] != '')

			{

				$_POST['from_city'] = $atts['from-city'];

			}
			if(isset($atts['condo']) && $atts['condo'] != '')
			{
				$_POST['condo'] = $atts['condo'];

			}
			if(isset($atts['address']) && $atts['address'] != '')
			{
				$_POST['address'] = $atts['address'];

			}
			$json_feed_url = $dbHost.$link;



			global $crawler;

			if ($crawler )

			{

				return null;

			}



			$json = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));

			$all  = json_decode($json['body']);

			$show = '';

			libxml_use_internal_errors(true);

			/*foreach($all->listing as $s)

			{

				@$dom = new DOMDocument;

				$dom->loadHTML($s->listing);

				$img = null;

				$a   = null;

				foreach($dom->getElementsByTagName('img') as $node)

				{

					$img[] = $dom->saveHTML($node);

				}

				foreach($dom->getElementsByTagName('a') as $node)

				{

					$link = $node->getAttribute('href');

				}

				foreach($dom->getElementsByTagName('span') as $node)

				{

					if($node->getAttribute('class') == 'agentslider')

						$agent = $dom->saveHTML($node);

				}

				$li

					  = '

			<li class="list_item">'.'<a href="'.$link.'" target="_parent">'.'<div class="list_img" >'.$img[0].'</div>'.'<h5 class="list_info">'.'<p class="list_address list_street" >'.$s->info->UnparsedAddress.'</p>'.'<p class="list_address list_city" >'.$s->info->City.'</p>'.'<p class="list_price">'.$s->info->ListPrice.'</p>'.'<p class="list_features">'.'<label class="list_beds_lb" >Beds:</label><label class="list_beds">'.$s->info->Building->BedroomsTotal."</label>".'<label class="list_baths_lb">Baths:</label><label class="list_baths">'.$s->info->Building->BathroomTotal."</label>".'<label class="list_size_lb">Sq Ft:</label><label class="list_size">'.$s->info->Building->SizeInterior."</label>".'</p>'.'<p class="list_agent">'.$agent.'</p>'.'</h5>'.'</a>'.'</li>';

				$show .= $li;

			}*/

			foreach($all->listing as $s)

			{

				$dom = new DOMDocument;

				$dom->loadHTML($s->listing);

				$img = null;

				$a   = null;

				//echo "<pre>";print_r($s);

				foreach($dom->getElementsByTagName('img') as $node)

				{

					$img[] = $dom->saveHTML($node);

				}

				foreach($dom->getElementsByTagName('a') as $node)

				{

					$link = $node->getAttribute('href');

				}

				foreach($dom->getElementsByTagName('span') as $node)

				{

					if($node->getAttribute('class') == 'agentslider')

						$agent = $dom->saveHTML($node);

				}
				if(isset($s->info->ShowPrice) && $s->info->ShowPrice == 1)
				{
					$price = $s->info->ListPrice;
				}
				else{
					$price = '';
				}


				$section = '

                        <div class="carousel-col">

                            <a href="'.$link.'" target="_parent">

                                <div class="block  img-responsive">'.$img[0].'</div>

                                <div >

                                 <h5 class="list_info">

                                 <p class="list_address list_street" >'.$s->info->UnparsedAddress.'</p>

                                 <p class="list_address list_city" >'.$s->info->City.'</p>

                                 <p class="list_price">'.$price.'</p>

                                 <p class="list_features">

                                    <label class="list_beds_lb" >Beds:</label>

                                    <label class="list_beds">'.$s->info->Building->BedroomsTotal.'</label>

                                    <label class="list_baths_lb">Baths:</label><label class="list_baths">'.$s->info->Building->BathroomTotal.'</label>

                                    <label class="list_size_lb">Sq Ft:</label><label class="list_size">'.$s->info->Building->SizeInterior.'</label></p><p class="list_agent">'.$agent.'</p></h5>

                                </div>

                            </a>

                        </div>

                    ';

				$show .= $section;

			}

			$realurl2 = get_post($options['webkits_listing_page']);



			$show = str_replace("{{CHANGEURL}}", $realurl2->guid."&l=", $show);



			require("includes/main_slider.php");

			break;

		case 'carousel_slider':

			if($args['type'] == 'random')

				$link = "slider/random/".$options['webkits_site_type']."/".$options['webkits_list_id'];

			else

				$link = "slider/latest/".$options['webkits_site_type']."/".$options['webkits_list_id'];





			if(isset($atts['from-city']) && $atts['from-city'] != '')

			{

				$_POST['from_city'] = $atts['from-city'];

			}

			$json_feed_url = $dbHost.$link;

			global $crawler;

			if ($crawler )

			{

				return null;

			}

			$json = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));

			$all  = json_decode($json['body']);


			libxml_use_internal_errors(true);

			$show = '';

			foreach($all->listing as $s)

			{

				$dom = new DOMDocument;

				$dom->loadHTML($s->listing);

				$img = null;

				$a   = null;

				//echo "<pre>";print_r($s);

				foreach($dom->getElementsByTagName('img') as $node)

				{

					$img[] = $dom->saveHTML($node);

				}

				foreach($dom->getElementsByTagName('a') as $node)

				{

					$link = $node->getAttribute('href');

				}

				foreach($dom->getElementsByTagName('span') as $node)

				{

					if($node->getAttribute('class') == 'agentslider')

						$agent = $dom->saveHTML($node);

				}



				$section

					= '

			        <section>

                    <div class="ss-row gglass go-anim"><!-- greensea is the class for the color scheme(there are 19) go-anim is for slide up animation on roll over -->

                        

                        <div class="-hover-effect h-style img-block">

                            <a href="'.$link.'" >'.$img[0].'

                                <div class="mask"><i class="icon-search"></i>

                                    <span class="img-rollover"></span>

                                </div>

                            </a>



                        </div>

                        <!--<div class="hover-effect h-style">

                            <a href="images/preview/01.jpg" rel="prettyPhotoImages[7]">

                                <img src="images/preview/01.jpg" class="clean-img">

                                <div class="mask"><i class="icon-search"></i>

                                    <span class="img-rollover"></span>

                                </div>

                            </a>

                        </div>-->

                        

                        <div class="ss-container">

                            <h3 class="content-title"><a href="'.$link.'">'.$s->info->UnparsedAddress.'</a></h3>

                            <div>'.wp_trim_words($s->info->PublicRemarks, 40).'

                                <!--<a href="#" data-target=""> <strong>Read more</strong>  <i class="icon-long-arrow-right"></i></a>-->

                            </div>

                            

                            <!-- START INFO HOLDER -->

                            <div class="icon-soc-container">

                                <div class="share-btns detail-sec">

                                    <div class="empty-left time-holder "> <i class="fa fa-bed -icon-large"></i><span> '.$s->info->Building->BedroomsTotal.'</span></div>

                                    <div class="empty-left user-holder"><i class="fa fa-bathtub -icon-large"></i><span> '.$s->info->Building->BathroomTotal.'</span> </div>

                                    ';

				/*if(!empty($s->info->Building->SizeInterior))

				{

					$section .= '<div class="empty-left user-holder"> <i class="fa fa-square icon-large"></i> '.$s->info->Building->SizeInterior.'</div>

								';

				}*/

				$section

					.= '

                            <!-- END INFO HOLDER -->

                            <div class="font-w-normal empty-left city-holder -time-holder"><span>&nbsp;&nbsp;'.$s->info->City.'</span></div>

                            <!-- START SHARE BUTTON -->

            <div class="empty-right">'.$s->info->ListPrice.'</div>

            

            <!-- END SHARE BUTTON -->

                        </div>

                    </div>

                </section>';



				$show .= $section;

			}//die;





			$realurl2 = get_post($options['webkits_listing_page']);



			$show = str_replace("{{CHANGEURL}}", $realurl2->guid."&l=", $show);



			require("includes/new_main_slider.php");

			break;

	}

	$content .= ob_get_clean();



	return $content;

}



//SHORTCODE

function webkits_agents_shortcode($atts, $content = null)

{

	$args = (shortcode_atts(array('section' => "agents", 'filter' => '','show_commercial' => ''), $atts));

	if(!wp_script_is("agents", "enqueued"))

	{

		wp_enqueue_style('listnav', plugin_dir_url(__FILE__).('public/css/listnav.css'));

		wp_enqueue_script('listnav', plugin_dir_url(__FILE__).'public/js/jquery-listnav.js', array('jquery'), '', true);

		wp_enqueue_script('agents', plugin_dir_url(__FILE__).'public/js/agent.js', array('jquery'), '', true);

	}



	##TEMPORARY

	$scriptUrl = admin_url('admin-ajax.php');

	$options   = get_option("webkits");

	$realurl   = get_post($options['webkits_agent_page']);

	ob_start();

	$filter = array();


	switch($args['section'])

	{

		case 'agents':

			echo "<script> var realurl = '".$realurl->guid."&l=';

var agent = ".$options['webkits_list_id'].";

var ajaxurl = '".$scriptUrl."';

var filter = '".$args['filter']."';
var show_commercial = '".$args['show_commercial']."';

</script>";

			require("includes/agent_page.php");

			break;

		case 'search':

			require("includes/agent_search.php");

			break;

	}

	$content = ob_get_clean();



	return $content;

}



//ACTION

function webkits_styles()

{

	wp_enqueue_style('bootstrap', plugin_dir_url(__FILE__).('public/css/bootstrap.min.css'));

	wp_enqueue_style('bootstrap-theme', plugin_dir_url(__FILE__).('public/css/bootstrap-theme.min.css'));

	wp_enqueue_style('dd-theme', plugin_dir_url(__FILE__).('public/css/themesv1.1.css?v=1.2'));

	wp_enqueue_style('fa', ('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'));

}



//ACTION

function webkits_js()

{

	wp_enqueue_script('bootstrapjs', plugin_dir_url(__FILE__).'public/js/bootstrap.min.js', array('jquery'), '', false);


}



//ACTION - MOTOPRESS

function extendTemplates($motopressCELibrary)
{

	$options['webkits_feature_template'] = " ";

	$options                             = get_option('webkits');

	if($options['webkits_feature_template'] == null || $options['webkits_feature_template'] == "")

		$options['webkits_feature_template'] = "temp";

	$template = new MPCETemplate('webkits_listings', 'Listing Template', $options['webkits_feature_template'], 'plugins/webkits/product-page.png');

	$motopressCELibrary->addTemplate($template);

}



//AJAX

function webkits_change_view()

{

	$_SESSION['webkits-view'] = $_POST['view'];

	die();

}

function webkits_register()
{

	global $wp,$Action;


	global $wp,$dbHost,$crawler;
	$_POST['website_url'] = home_url( $wp->request );
	$link          = "User/register";

	$json_feed_url = $dbHost.$link;

	if ($crawler )

	{

		return null;

	}

	$json          = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));

	$res = json_decode($json['body']);

	if($res->status == 'success')
	{
		$subject = get_bloginfo( 'name' ) . ' Lead : New User Registration ';

		$ActivationLink    =   GenerateUserAccountActivationLink($res->id, $_POST['user_email']);
		require('includes/register_mail.php');

		$user_subject = 'Thank You for Registering with '.get_bloginfo( 'name' );
		//echo $user_mail_body;die;


		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		$options                             = get_option('webkits');

		$mail = wp_mail($options['webkits_register_email'],$subject,$mail_body,$headers);
		$mail = wp_mail($_POST['user_email'],$user_subject,$user_mail_body,$headers);
	}

	wp_send_json( $res );

}
function webkits_user_activation($account)
{
	global $wp,$crawler,$dbHost;

	$options                             = get_option('webkits');
	$sold_page = get_post($options['webkits_sold_listings_page']);
	$details = unserialize(base64_decode($account));

	$POST['user_email'] = $details[0];
	$POST['user_id'] =  $details[1];

	$keywordArr = array ('service','property','home','listing','dallas',
	                     'Documents','Hunter','client','search','lender',
	                     'Club','Vehicles','Neo', 'Morpheus', 'Trinity', 'Cypher', 'Tank');

	$rand_keys 	= array_rand($keywordArr);
	$rand_digit = mt_rand(10, 99);
	$keyword    = $keywordArr[$rand_keys];
	$randstr    = $keyword.$rand_digit;


	$POST['user_password'] = $randstr;
	$link          = "User/activate";

	$json_feed_url = $dbHost.$link;


	if ($crawler )
	{
		return null;
	}

	$json          = wp_remote_post($json_feed_url, array("body" => array("p" => $POST)));


	$res = json_decode($json['body']);

	if($res->status == 'success')
	{
		$login_url = get_permalink($sold_page->ID);

		require('includes/activate_mail.php');
		$user_subject = 'Your account is successfully activated';

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		$mail = wp_mail($POST['user_email'],$user_subject,$mail_body,$headers);
		wp_redirect(get_permalink($sold_page->ID).'?success=true');

		exit;
	}
	wp_redirect(get_permalink($sold_page->ID).'?error=true');
	exit;
}
function webkits_login()
{
	global $dbHost,$crawler,$wp;

	$link          = "User/login";

	$json_feed_url = $dbHost.$link;

	if ($crawler )

	{

		return null;

	}
	$_POST['website_url'] = home_url( $wp->request );
	$json          = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));
	$res = json_decode($json['body']);

	$options = get_option('webkits');
	if($res->status == 'success')
	{
		global $User_Perm,$User_Logged;
		session_start();
		$_SESSION['User_Perm']	=	'User';
		$_SESSION['User_Logged']	=	true;
		$_SESSION['UserId']	=	$res->id;

		$resp['status'] = 'success';
		$resp['login_url'] = home_url( $wp->request ).'/'.get_post($options['webkits_sold_listings_page'])->post_name;

		wp_send_json( $resp );


	}
	else{
		wp_send_json( $res );
	}
}
function webkits_forgot(){
	global $dbHost,$crawler,$wp;
	//echo "<pre>";print_r($_POST);die;
	$link          = "User/forgot";

	$json_feed_url = $dbHost.$link;

	if ($crawler )
	{
		return null;
	}

	$keywordArr = array ('service','property','home','listing','dallas',
	                     'Documents','Hunter','client','search','lender',
	                     'Club','Vehicles','Neo', 'Morpheus', 'Trinity', 'Cypher', 'Tank');
	$rand_keys 	= array_rand($keywordArr);
	$rand_digit = mt_rand(10, 99);
	$keyword    = $keywordArr[$rand_keys];
	$randstr    = $keyword.$rand_digit;
	$_POST['user_password'] = $randstr;
	$_POST['website_url'] = home_url( $wp->request );
	$json          = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));

	$res = json_decode($json['body']);

	if($res->status == 'success')
	{

		require('includes/forgot_mail.php');

		$subject = 'Password Reminder';

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		$options                             = get_option('webkits');

		$mail = wp_mail($_POST['username'],$subject,$mail_body,$headers);


	}
	wp_send_json( $res );

}
// Activate Account

function GenerateUserAccountActivationLink($user_id,$user_email)
{
	global $wp;

	if(!is_numeric($user_id))
		return false;

	$code = serialize(array($user_email,$user_id));
	$code = base64_encode($code);

	$url = home_url( $wp->request ).'/activation/'.$code;

	return $url;
}



//PAGINATION

function renderNavigation($cntAround = 1, $cntPages = 1, $current = 1)

{

	$out      = '';

	$isGap    = false;

	$cntPages = ceil($cntPages);

	$current--;

	for($i = 0; $i < $cntPages; $i++)

	{

		$isGap = false;



		if($cntAround >= 0 && $i > 0 && $i < $cntPages - 1 && abs($i - $current) > $cntAround)

		{

			$isGap = true;

			$i     = ($i < $current?$current - $cntAround:$cntPages - 1) - 1;

		}

		$lnk = ($isGap?'<li><a href="#">...</a></li>':($i + 1));

		if($i != $current && !$isGap)

		{

			$params = $_GET;

			unset($params["listing-page"]);

			$params["listing-page"] = $i + 1;

			$link                   = basename($_SERVER['PHP_SELF']).'?'.http_build_query($params);

			$lnk                    = '<li><a href="'.$link.'">'.$lnk.'</a></li>';



		}

		if($i == $current)

		{

			$lnk = '<li class="active"><a href="#">'.$lnk.'</a></li>';

		}

		$out .= $lnk;

	}



	return $out;

}



//SHORTCODE

function webkits_listings_sc($atts, $content = null)

{

	global $dbHost;

	session_start();


	//echo "<pre>";print_r($atts);die;
	if(!wp_script_is("listings", "enqueued"))

	{



		wp_enqueue_style('map', plugin_dir_url(__FILE__).('public/css/map.css'));

		wp_enqueue_script('mpce-gma-google-maps-api', 'http://maps.google.com/maps/api/js?key=AIzaSyDZ9XDDXc0IBIOPhc3Hw1TaXJEDR2LpU3k', '', '', true);

		wp_enqueue_script('gmap', plugin_dir_url(__FILE__).'public/js/map.js', array('jquery'), '', true);

		wp_enqueue_script('cluster', plugin_dir_url(__FILE__).'public/js/marker.js', array('jquery'), '', true);

		wp_enqueue_script('listings', plugin_dir_url(__FILE__).'public/js/listings.js', array('jquery'), '', true);

		wp_enqueue_script('common', plugin_dir_url(__FILE__).'public/js/common.js', array('jquery'), '', true);

		wp_enqueue_script('masonary', plugin_dir_url(__FILE__).'public/js/masonry.min.js', array('jquery'), '', true);

		wp_enqueue_script('search', plugin_dir_url(__FILE__).'public/js/search.js', array('jquery'), '', true);



	}



	foreach($_POST as $k => $v)

	{

		if(strpos($k, "wk-") !== false)

		{

			$_POST[str_replace("wk-", "", $k)] = $v;

			unset($_POST[$k]);

		}

	}



	$options = get_option("webkits");



	if(isset($_POST['clear']) && (isset($_SESSION['webkit-search']) || isset($_SESSION['webkit-sold-search'])))

	{

		if(isset($_SESSION['webkit-search']))
		{
			unset($_SESSION['webkit-search']);
		}
		if(isset($_SESSION['webkit-sold-search']))
		{
			unset($_SESSION['webkit-sold-search']);
		}


		unset($_POST);
		$Is_Search = false;
		header('Location: '.$_SERVER['REQUEST_URI']);



	}





	$realurl = get_post($options['webkits_listing_page']);



	$args = (shortcode_atts(array('section' => "listings", 'filter' => '', 'show' => 0, "all" => 1, "all_agent" => 1,), $atts));



	$check = "";

	$main  = '';

	if(isset($_POST['srch-term']))

	{

		if($_POST['srch-term'] == "openhouse")

		{

			$check = "checked='checked'";

		}

		else

		{

			$main = $_POST['srch-term'];

		}

	}

    elseif(isset($_POST['srch-term']) && $_POST['input_main'])

	{

		$main = $_POST['input_main'];

	}

	ob_start();



	switch($args['section'])

	{

		case 'counter':

			require "includes/listing_counter.php";

			break;

		case 'sold-button':

			if($options['webkits_enable_sold'] == SOLD_PASSWORD)
			{
				wp_enqueue_script('jquery-v', plugin_dir_url(__FILE__).('public/js/jquery-validation-1.16.0/dist/jquery.validate.js'));
				wp_enqueue_script('login', plugin_dir_url(__FILE__).'public/js/login.js', array('jquery'), '', true);
				require "includes/register-login.php";
			}
			require "includes/sold_button.php";

			break;



		case 'listings-filtered':

			$listingPerPage = $options['webkits_listing_perpage'];

			$hideAgent      = isset($options['webkits_hide_agents'])?$options['webkits_hide_agents']:0;



			$officeMlsId = (isset($options['webkits_officemlsid']) && !empty($options['webkits_officemlsid']))?explode('|', $options['webkits_officemlsid']):'';

			$agentId     = (isset($options['webkits_agentid']) && !empty($options['webkits_agentid']))?explode('|', $options['webkits_agentid']):'';




			if(isset($_GET['listing-page']) && is_numeric($_GET['listing-page']))

			{

				$_POST['offset'] = $listingPerPage * ($_GET['listing-page'] - 1);



				$CurrentPage = $_GET['listing-page'];

			}

			else

			{

				$CurrentPage = 1;

			}

			if(isset($officeMlsId) && !empty($officeMlsId) && is_array($officeMlsId) && count($officeMlsId) > 0 && isset($args['all']) && ($args['all'] == false || $args['all'] == '0' || $args['all'] == 0))

			{

				$_POST['officeMlsId'] = $officeMlsId;

			}

			if(isset($agentId) && !empty($agentId) && is_array($agentId) && count($agentId) > 0 && isset($args['all_agent']) && ($args['all_agent'] == false || $args['all_agent'] == '0' || $args['all_agent'] == 0))

			{

				$_POST['AgentId'] = $agentId;

			}





			//echo "<pre>";print_r($_POST);die;

			if(isset($args['filter']))

			{

				switch($args['filter'])

				{

					case 'openhouse':

						$link = "Show/OpenHouse/".$options['webkits_site_type']."/".$options['webkits_list_id'];

						if(isset($_POST['pressed']))

						{

							unset($_POST['pressed']);



							$_POST['offset'] = 0;



							header('Location: '.$_SERVER['REQUEST_URI']);

						}

						break;

					case 'commercial':

						$link = "Show/Commercial/".$options['webkits_site_type']."/".$options['webkits_list_id'];

						break;

					case 'carriagetrade':

						$link = "Show/CarriageTrade/".$options['webkits_site_type']."/".$options['webkits_list_id'];

						break;

					case 'waterfront':

						$link = "Show/waterfront/".$options['webkits_site_type']."/".$options['webkits_list_id'];

						break;

					default:

						$link = "Show/{$args['filter']}/".$options['webkits_site_type']."/".$options['webkits_list_id'];

						break;

				}

			}



			$json_feed_url = $dbHost.$link;



			$_POST['data']    = $_POST;

			$_POST['perpage'] = $listingPerPage;



			global $crawler;

			if ($crawler )

			{

				return null;

			}

			$json = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));

			$listings = json_decode($json['body']);

			$allListings = json_decode($json['body']);

			require "inc/listing_page.php";

			break;

		case 'sold-listings':
			global $_SESSION;

			if($options['webkits_enable_sold'] == SOLD_PASSWORD)
			{

				wp_enqueue_script('jquery-v', plugin_dir_url(__FILE__).('public/js/jquery-validation-1.16.0/dist/jquery.validate.js'));
				wp_enqueue_script('login', plugin_dir_url(__FILE__).('public/js/login.js'));
				$listingPerPage = $options['webkits_listing_perpage'];

				$Is_Search   = false;
				$listingpage = get_post($options['webkits_listing_page'])->guid."&l=";

				$hideAgent = isset($options['webkits_hide_agents'])?$options['webkits_hide_agents']:0;


				if(isset($_GET['listing-page']) && is_numeric($_GET['listing-page']))

				{

					$_POST['offset'] = $listingPerPage * ($_GET['listing-page'] - 1);


					$CurrentPage = $_GET['listing-page'];

				}

				else

				{

					$CurrentPage = 1;

				}

				//echo "<pre>";print_r($_POST);die;



				if(isset($atts['onlyshow']) && $atts['onlyshow'] != '')

				{

					$_POST['onlyshow'] = $atts['onlyshow'];
					if(isset($options['webkits_oreb_id']) && $options['webkits_oreb_id'] != '')
					{
						$_POST['agent_id'] = $options['webkits_oreb_id'];
					}
					unset($_SESSION['webkit-sold-search']);
				}
				else{
					if(isset($_POST['input']))
					{
						$_POST['input_main'] = $_POST['input'];
					}
					if(isset($_POST['srch-term']))

					{

						if($_POST['srch-term'] != "openhouse")

						{

							$_POST['input_main'] = $_POST['srch-term'];

						}


					}


					if(isset($atts['from-city']) && $atts['from-city'] != '')

					{

						$_POST['from_city'] = $atts['from-city'];

					}
					if(isset($atts['maxprice']))

					{

						$_POST['maxprice'] = $atts['maxprice'];

					}

					if(isset($atts['postal']))

					{

						$_POST['postal'] = strtoupper($atts['postal']);

					}

					if(isset($atts['commercial']) && $atts['commercial'] == '1')

					{

						$_POST['commercial'] = 1;

					}

					if(isset($atts['lots']) && $atts['lots'] == '1')

					{

						$_POST['lots'] = 1;

					}

					if(isset($atts['retail']) && $atts['retail'] == '1')

					{

						$_POST['retail'] = 1;

					}

					if(isset($atts['condo']) && $atts['condo'] == 1)

					{

						$_POST['condo'] = 1;

						$_POST['condo_search'] = true;


					}


					if(isset($atts['address']) && $atts['address'] != '')

					{

						$arraddress = explode('|', $atts['address']);


						if(is_array($arraddress) && count($arraddress) > 0)

						{

							$_POST['address'] = $arraddress;

						}

					}

					if(isset($_POST['pressed']))
					{
						$_POST['is_search'] = true;
						$search             = $_POST['search'];

						unset($_POST['pressed']);

						$_POST['live-search'] = true;

						$CurrentPage = 1;

						$_POST['offset'] = 0;

						$_SESSION['webkit-sold-search'] = $_POST;
					}
					if(!isset($_POST['condo_search']) && !isset($_POST['input_main']) && isset($_SESSION['webkit-sold-search']))

					{
						$_POST = $_SESSION['webkit-sold-search'];

					}
					//FERNSIDE STREET,FINLAYSON CRESCENT,NOBLE CRESCENT,noble crescent//19663544

				}

				if(isset($_POST['srch-term']))
				{
					if($_POST['srch-term'] == "openhouse")

					{

						$link = "ShowOpenHouse/".$options['webkits_site_type']."/".$options['webkits_list_id'];

					}

				}

				//$link = "ShowSoldListings/".$options['webkits_site_type']."/".$options['webkits_oreb_id'];
				$link = "ShowSoldListings/";

				$json_feed_url = $dbHost.$link;

				//echo $json_feed_url;die;

				$_POST['data'] = $_POST;

				$_POST['perpage'] = $listingPerPage;

				//echo "<pre>";print_r($_POST);die;

				global $crawler;

				if($crawler)

				{

					return null;

				}
				if((isset($_POST['input']) && $_POST['input'] != '') || (isset($_POST['onlyshow']) && $_POST['onlyshow'] != ''))
				{
					$Is_Search = true;
				}
				else
				{
					$Is_Search = false;
				}

				if($Is_Search == true){
					$json = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));


					$listings = json_decode($json['body']);

				}
				else{
					$Is_Search = false;
				}

				$options   = get_option("webkits");

				$realurl   = get_post($options['webkits_listings_page']);

				require "includes/register-login.php";

				require "inc/listing_sold_page.php";

				if(isset($search))
					$_POST['search'] = $search;

			}
			break;

		case 'listings':

			global $_SESSION;

			wp_enqueue_script('jquery-v', plugin_dir_url(__FILE__).('public/js/jquery-validation-1.16.0/dist/jquery.validate.js'));
			wp_enqueue_script('login', plugin_dir_url(__FILE__).('public/js/login.js'));

			$listingPerPage = $options['webkits_listing_perpage'];

			$listingpage    = get_post($options['webkits_listing_page'])->guid."&l=";

			$hideAgent      = isset($options['webkits_hide_agents'])?$options['webkits_hide_agents']:0;



			if(isset($_GET['listing-page']) && is_numeric($_GET['listing-page']))

			{

				$_POST['offset'] = $listingPerPage * ($_GET['listing-page'] - 1);



				$CurrentPage = $_GET['listing-page'];

			}

			else

			{

				$CurrentPage = 1;

			}



			if(isset($_POST['srch-term']))

			{

				if($_POST['srch-term'] != "openhouse")

				{

					$_POST['input_main'] = $_POST['srch-term'];

				}



			}



			if(isset($atts['from-city']) && $atts['from-city'] != '')

			{

				$_POST['from_city'] = $atts['from-city'];

			}

			if(isset($atts['listing-days']) && $atts['listing-days'] != '')
			{
				$_POST['listing_days']=$atts['listing-days'];
			}
			if(isset($atts['sort']) && $atts['sort'] != '')
			{
				$_POST['sort']=$atts['sort'];
			}

			if(isset($atts['onlyshow']) && $atts['onlyshow'] != '')

			{

				$_POST['onlyshow'] = $atts['onlyshow'];

			}

			if(isset($atts['maxprice']))
			{

				$_POST['maxprice'] = $atts['maxprice'];

			}
			if(isset($atts['minprice']))
			{

				$_POST['minprice'] = $atts['minprice'];

			}
			if(isset($atts['postal']))

			{

				$_POST['postal'] = strtoupper($atts['postal']);

			}

			if(isset($atts['commercial']) && $atts['commercial'] == '1')
			{

				$_POST['commercial'] = 1;

			}
			//echo "<pre>";print_r($atts);die;

			if(isset($atts['industrial']) && $atts['industrial'] == '1')
			{

				$_POST['industrial'] = 1;

			}
			if(isset($atts['farm']) && $atts['farm'] == '1')
			{

				$_POST['farm'] = 1;

			}
			if(isset($atts['lots']) && $atts['lots'] == '1')

			{

				$_POST['lots'] = 1;

			}

			if(isset($atts['retail']) && $atts['retail'] == '1')

			{

				$_POST['retail'] = 1;

			}

			if(isset($atts['condo']) && $atts['condo'] == 1)

			{

				$_POST['condo']        = 1;

				$_POST['condo_search'] = true;



			}


			if(isset($atts['address']) && $atts['address'] != '')

			{

				$arraddress = explode('|', $atts['address']);



				if(is_array($arraddress) && count($arraddress) > 0)

				{

					$_POST['address'] = $arraddress;

				}



				/* if(strpos($atts['address'],',') != false)

				{

					$address = explode(',',$atts['address']);



					if(isset($address[0]))

						$_POST['address'] = $address[0];



					if(isset($address[1]))

						$_POST['city'] = $address[1];



					if(isset($address[2]))

						$_POST['postalcode'] = $address[2];

				}

				else {

					$_POST['address'] = $atts['address'];

				}*/

			}



			if(isset($_POST['pressed']))

			{



				$search = $_POST['search'];

				unset($_POST['pressed']);

				$_POST['live-search']      = true;

				$CurrentPage               = 1;

				$_POST['offset']           = 0;

				$_SESSION['webkit-search'] = $_POST;



				header('Location: '.$_SERVER['REQUEST_URI']);

				//header('Location: '.$_SERVER['HTTP_HOST'].'/listings');



			}



			if(!isset($_POST['condo_search']) && !isset($_POST['input_main']) && isset($_SESSION['webkit-search']))

			{

				$_POST = $_SESSION['webkit-search'];

			}



			//FERNSIDE STREET,FINLAYSON CRESCENT,NOBLE CRESCENT,noble crescent//19663544

			$link = "ShowListings/".$options['webkits_site_type']."/".$options['webkits_list_id'];
			$ll_apikey     = (isset($options['webkits_ll_apikey']) && !empty($options['webkits_ll_apikey']))? $options['webkits_ll_apikey']:'';


			if(isset($_POST['srch-term']))

			{



				if($_POST['srch-term'] == "openhouse")

				{

					$link = "ShowOpenHouse/".$options['webkits_site_type']."/".$options['webkits_list_id'];

				}

			}



			$link = "ShowListings/".$options['webkits_site_type']."/".$options['webkits_list_id'];



			$json_feed_url = $dbHost.$link;

			//echo $json_feed_url;die;

			//return $json_feed_url;

			$_POST['data']    = $_POST;

			$_POST['perpage'] = $listingPerPage;

			//echo "<pre>";print_r($_POST);die;

			global $crawler;

			if ($crawler )

			{

				return null;

			}
			//echo "<pre>";print_r($_POST);die;
			$json = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));

			$listings = json_decode($json['body']);
			//            echo "<pre>";print_r($listings);die;
			$link          = "creb/".$options['webkits_site_type']."/".$options['webkits_list_id'];

			$json_feed_url = $dbHost.$link;

			global $crawler;

			if ($crawler )

			{

				return null;

			}

			/*$json          = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));

			//$result = json_decode($json['body']);

			if($result->creb == true)
			{
				$creb = true;
			}*/

			require "inc/listing_page.php";

			if($options['webkits_enable_sold'] == SOLD_PASSWORD)
				require "includes/register-login.php";

			if(isset($search))
				$_POST['search'] = $search;
			//die;
			break;





		case 'second-listings':

			wp_enqueue_script('listings2', plugin_dir_url(__FILE__).'public/js/listings2.js', array('jquery'), '', true);

			if(isset($_POST['search']))

			{





				$listingPerPage = $options['webkits_listing_perpage'];

				$listingpage    = get_post($options['webkits_listing_page'])->guid."&l=";

				$hideAgent      = isset($options['webkits_hide_agents'])?$options['webkits_hide_agents']:0;



				if(isset($_GET['listing-page']) && is_numeric($_GET['listing-page']))

				{

					$_POST['offset'] = $listingPerPage * ($_GET['listing-page'] - 1);



					$CurrentPage = $_GET['listing-page'];

				}

				else

				{

					$CurrentPage = 1;

				}

				if(isset($_POST['srch-term']))

				{

					if($_POST['srch-term'] != "openhouses")

					{

						$_POST['input_main'] = $_POST['srch-term'];

					}



				}

				if(isset($_POST['search']))

				{

					unset($_POST['search']);

					$CurrentPage               = 1;

					$_POST['offset']           = 0;

					$_SESSION['webkit-search'] = $_POST;

					header('Location: '.$_SERVER['REQUEST_URI']);

				}



				//echo $_POST['offset'];

				if(!isset($_POST['input_main']) && isset($_SESSION['webkit-search']))

				{

					$_POST = $_SESSION['webkit-search'];

				}



				$link = "ShowListings/".$options['webkits_ssite_type']."/".$options['webkits_slist_id'];



				if(isset($_POST['srch-term']))

				{

					if($_POST['srch-term'] == "openhouses")

					{

						$link = "ShowOpenHouse/".$options['webkits_ssite_type']."/".$options['webkits_ssite_type'];

					}



				}



				$json_feed_url    = $dbHost.$link;

				$_POST['data']    = $_POST;

				$_POST['perpage'] = $listingPerPage;

				global $crawler;

				if ($crawler )

				{

					return null;

				}

				$json             = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));

				$listings         = json_decode($json['body']);

				include "inc/listing_page2.php";

			}

			break;





		case 'map':



			$listingPerPage = '4000';

			$listingpage    = get_post($options['webkits_listing_page'])->guid."&l=";

			$hideAgent      = isset($options['webkits_hide_agents'])?$options['webkits_hide_agents']:0;



			echo "<script>noCluster = false;</script>";

			require "includes/listing_map.php";

			if(isset($search))

				$_POST['search'] = $search;

			break;

		case 'search':

			wp_enqueue_style('jquery-mob', plugin_dir_url(__FILE__).('public/css/ion.rangeSlider.css'));

			wp_enqueue_style('jquery-mob2', plugin_dir_url(__FILE__).('public/css/ion.rangeSlider.skinHTML5.css'));

			wp_enqueue_script('jquery-m', plugin_dir_url(__FILE__).('public/js/ion.rangeSlider.min.js'));

			if(!isset($_POST['input_main']) && isset($_SESSION['webkit-search']))

			{

				$_POST = $_SESSION['webkit-search'];

			}



			if($_POST['input_open_house'] == 1)

			{

				$check = "checked='checked'";

			}



			$link          = "GetOffices/".$options['webkits_site_type']."/".$options['webkits_list_id'];

			$json_feed_url = $dbHost.$link;



			global $crawler;



			if ($crawler )

			{

				return null;

			}

			$json = wp_remote_post($json_feed_url, array());



			//$offices = json_decode($json['body']);

			require "inc/listing_search.php";

			break;

		case 'sold-search-form':
			global $_SESSION;
			if($options['webkits_enable_sold'] == SOLD_PASSWORD)
			{
				wp_enqueue_style('jquery-mob', plugin_dir_url(__FILE__).('public/css/ion.rangeSlider.css'));

				wp_enqueue_style('jquery-mob2', plugin_dir_url(__FILE__).('public/css/ion.rangeSlider.skinHTML5.css'));

				wp_enqueue_style('jquery-ui-css', plugin_dir_url(__FILE__).('public/css/jquery-ui.min.css'));

				wp_enqueue_script('jquery-m', plugin_dir_url(__FILE__).('public/js/ion.rangeSlider.min.js'));

				wp_enqueue_script('jquery-ui', plugin_dir_url(__FILE__).('public/js/jquery-ui.min.js'));

				if(!isset($_POST['input_main']) && isset($_SESSION['webkit-sold-search']))

				{

					$_POST = $_SESSION['webkit-sold-search'];

				}


				if($_POST['input_open_house'] == 1)

				{

					$check = "checked='checked'";

				}


				$link = "GetOffices/".$options['webkits_site_type']."/".$options['webkits_list_id'];

				$json_feed_url = $dbHost.$link;


				global $crawler;


				if($crawler)

				{

					return null;

				}

				$json = wp_remote_post($json_feed_url, array());


				$offices = json_decode($json['body']);

				require "inc/listing_sold_search.php";
			}
			break;

		case 'full-search':

			wp_enqueue_style('jquery-mob', plugin_dir_url(__FILE__).('public/css/ion.rangeSlider.css'));

			wp_enqueue_style('jquery-mob2', plugin_dir_url(__FILE__).('public/css/ion.rangeSlider.skinHTML5.css'));

			wp_enqueue_script('jquery-m', plugin_dir_url(__FILE__).('public/js/ion.rangeSlider.min.js'));



			if(!isset($_POST['input_main']) && isset($_SESSION['webkit-search']))

			{

				$_POST = $_SESSION['webkit-search'];

			}



			if($_POST['input_open_house'] == 1)

			{

				$check = "checked='checked'";

			}



			$link          = "GetOffices/".$options['webkits_site_type']."/".$options['webkits_list_id'];

			$json_feed_url = $dbHost.$link;



			//file_put_contents('000.txt',$json_feed_url);

			//error_reporting(E_ERROR | E_WARNING | E_PARSE);

			//ini_set('display_errors', 1);

			/*$json    = wp_remote_post('http://inside.bulkbuyonly.com/api.php',

									  array('area'=> 'Master','module'=>'GetFabricList','token'=>'.CL5xHL!3rHn1#bHkJ5w^M0VH~W7oC5s.')

			);

			WP_Error Object

			(

				[errors] => Array

					(

						[http_request_failed] => Array

							(

								[0] => cURL error 6: Could not resolve host: inside.bulkbuyonly.com

							)



					)



				[error_data] => Array

					(

					)



			)

			*/

			global $crawler;

			if ($crawler )

			{

				return null;

			}

			$json = wp_remote_post($json_feed_url, array());

			/*

			WP_Error Object

			(

				[errors] => Array

					(

						[http_request_failed] => Array

							(

								[0] => cURL error 7: Failed to connect to webkitadmin.project port 7700: No route to host

							)



					)



				[error_data] => Array

					(

					)



			)

			*/



			//file_put_contents('000.txt',print_r($json,true));exit;



			$offices = json_decode($json['body']);

			require "includes/listing_search.php";

			break;



	}



	$content = $start;

	$content .= ob_get_clean();



	return $content;

}




function wti_loginout_menu_link( $items, $args ) {

	if(isset($_SESSION['User_Logged']) && $_SESSION['User_Logged'] == true)
	{

		$items .= '<li class="menu-item menu-item-type-post_type menu-item-object-page"><a title="Account" href="'.home_url().'?Action=logout"><img src="'.plugin_dir_url(__FILE__).'public/img/webkits-icon1.png" height="22"/> &nbsp;'. __("ACCOUNT") .'</a>';
		$items .= '
            <ul class="sub-menu">
                
                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1496"><a title="Change Password" href="'.home_url().'/change-password/">CHANGE PASSWORD</a></li>
                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1495"><a title="Edit Profile" href="'.home_url().'/edit-profile/">EDIT PROFILE</a></li>
                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1499"><a title="Logout" href="'.home_url().'/logout/">LOGOUT</a></li>
            </ul>
        </li>';
	}

	return $items;
}
function webkits_listings_user($atts,$content = null)
{
	global $dbHost;

	session_start();
	$options = get_option("webkits");
	$args = (shortcode_atts(array('section' => "change-password",), $atts));
	ob_start();
	if(isset($atts) && is_array($atts) && isset($atts['section']))
		switch($atts['section'])
		{
			case 'change-password':

				if(isset($_SESSION['User_Logged']) && $_SESSION['User_Logged'] == true)
				{
					wp_enqueue_script('jquery-v', plugin_dir_url(__FILE__).('public/js/jquery-validation-1.16.0/dist/jquery.validate.js'));
					wp_enqueue_script('login', plugin_dir_url(__FILE__).('public/js/login.js'));
					wp_enqueue_script('listings', plugin_dir_url(__FILE__).'public/js/myaccount.js', array('jquery'), '', true);

					if(isset($_POST['Update']) && $_POST['Update'] == "Change Password")
					{
						$link = "User/change-password";

						$json_feed_url = $dbHost.$link;

						global $crawler, $wp;

						if($crawler)

						{

							return null;

						}
						$_POST['user_id'] = $_SESSION['UserId'];
						$json             = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));

						$result = json_decode($json['body']);
						//echo home_url($wp->request);die;
						if($result->status == 'success')
						{
							header('location: '.home_url($wp->request).'?update=true');
							exit(0);
						}
						else
						{
							header('location: '.home_url($wp->request).'?update=false');
							exit(0);
						}
						// echo "<pre>";print_r($_POST);die;
					}

					//require_once "includes/change-password.php";
					require('includes/change-password.php');
					$content = ob_get_clean();


					return $content;
				}
				exit;
				break;
			case 'edit-profile':
				if(isset($_SESSION['User_Logged']) && $_SESSION['User_Logged'] == true)
				{
					$link = "User/edit-profile/get";

					$json_feed_url = $dbHost.$link;

					global $crawler, $wp;

					if($crawler)

					{

						return null;

					}
					$_POST['user_id'] = $_SESSION['UserId'];

					$json = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));

					$result = json_decode($json['body']);
					$user   = $result->user;
					if(($_POST['Submit'] == "Save Changes"))
					{
						$link = "User/edit-profile/post";

						$json_feed_url = $dbHost.$link;

						global $crawler, $wp;

						if($crawler)

						{

							return null;

						}
						$_POST['user_id'] = $_SESSION['UserId'];

						$json = wp_remote_post($json_feed_url, array("body" => array("p" => $_POST)));

						$result = json_decode($json['body']);
						if($result->status == 'success')
						{
							header('location: '.home_url($wp->request).'?update=true');
							exit(0);
						}
						else
						{
							header('location: '.home_url($wp->request).'?update=false');
							exit(0);
						}
					}
					//wp_head();
					require "includes/edit-profile.php";
					$content = ob_get_clean();


					return $content;
				}
				break;
			default:
				break;

		}

	$content .= ob_get_clean();

	return $content;
	//echo "<pre>";print_r($atts);die;
}
function webkits_register_login()
{
	ob_start();
	$options = get_option("webkits");
	if($options['webkits_enable_sold'] == SOLD_PASSWORD)
	{

		wp_enqueue_script('jquery-v', plugin_dir_url(__FILE__).('public/js/jquery-validation-1.16.0/dist/jquery.validate.js'));
		wp_enqueue_script('login', plugin_dir_url(__FILE__).('public/js/login.js'));
		include_once("includes/register-login.php");
	}
	$content = ob_get_clean();



	return $content;

}

add_action( 'init', 'wpse_init' );

function wpse_init() {
	add_rewrite_rule( '^logout$', 'index.php?Action=logout', 'top' );
	add_rewrite_rule(
		'^activation/?([^/]*)/?',
		'index.php?account=$matches[1]','top'

	);
}

// But WordPress has a whitelist of variables it allows, so we must put it on that list

function wpse_query_vars( $query_vars )
{
	$query_vars[] = 'Action';
	return $query_vars;
}
function account_query_vars( $query_vars )
{
	$query_vars[] = 'account';
	return $query_vars;
}
// If this is done, we can access it later
// This example checks very early in the process:
// if the variable is set, we include our page and stop execution after it

function wpse_parse_request( &$wp )
{
	if ( isset($wp->query_vars['Action']) && $wp->query_vars['Action'] == 'logout' ) {

		global $_SESSION;

		session_start();
		//echo "<pre>";print_r($wp->query_vars);die;


		unset($_SESSION['User_Logged']);
		unset($_SESSION['UserId']);
		unset($_SESSION['User_Perm']);

		header('location:'.home_url());
		exit;
	}

	if(isset($wp->query_vars["account"]) && $wp->query_vars["account"] != '')
	{
		do_action('wp_ajax_webkits_user_activation',$wp->query_vars["account"]);
	}
	if(is_array($_GET) && isset($_GET['login']) && $_GET['login'] == true)
	{

		do_shortcode('[login]');
	}
}

?>