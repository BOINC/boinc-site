<?php

// The authoritative copy of this is on GoDaddy.

// format:
//      description
//      date
//      type: JOURNAL/CONF/PATENT
//      area: SCI/BOINC/DASH/CM
//      URL

define('JOURNAL', 0);
define('CONF', 1);
define('TR', 2);
define('PATENT', 3);
define('MAG', 4);
define('BOOK', 5);

define('BOINC', 0);
define('SCI', 1);
define('CM', 2);
define('DASH', 3);
define('MISC', 4);
define('MUSIC', 5);

$pubs = array();

function str_to_time($x) {
    if (strchr($x, '-')) {
        $i = strpos($x, '-');
        $y = substr($x, 0, $i);
        $y .= strstr($x, ',');
        //echo "$x | $y\n";
        return strtotime($y);
    }
    if (is_numeric($x)) {
        return strtotime("Jan. 1 $x");
    }
    return strtotime($x);
}

function pub($desc, $date, $type, $area, $url=null) {
    global $pubs;
    $x = new StdClass;
    $x->desc = $desc;
    $x->date = $date;
    $x->time = str_to_time($date);
    $x->type = $type;
    $x->area = $area;
    $x->url = $url;
    $pubs[] = $x;
}

pub(
    "David P. Anderson.  Globally Scheduling Volunteer Computing. Future Internet 13(9), 229; https://doi.org/10.3390/fi13090229",
    "August 31, 2021",
    JOURNAL,
    BOINC,
    "https://www.mdpi.com/1999-5903/13/9/229"
);

pub(
    "David P. Anderson.  BOINC: A Platform for Volunteer Computing.  Journal of Grid Computing 18(1), p. 99-122.  DOI 10.1007/s10723-019-09497-9",
    "2020",
    JOURNAL,
    BOINC,
    "https://link.springer.com/article/10.1007/s10723-019-09497-9"
);

pub(
    "Zhi-Song Zhang et al.  First SETI observations with China’s five-hundred-meter aperture spherical radio telescope (FAST).  The Astrophysical Journal 891(2)",
    "Mar. 17, 2020",
    JOURNAL,
    SCI,
    "https://arxiv.org/pdf/2002.02130"
);

pub(
    " M. Lebofsky et al.  The Breakthrough Listen Search for Intelligent Life: Public Data, Formats, Reduction and Archiving.  Publications of the Astronomical Society of the Pacific",
    "November 5, 2019",
    JOURNAL,
    SCI,
    "https://iopscience.iop.org/article/10.1088/1538-3873/ab3e82"
);

pub(
    "C.J. Clark et al.  Einstein@Home Discovers a Radio-quiet Gamma-ray Millisecond Pulsar.  Science Advances 4(2)",
    "February 2018",
    JOURNAL,
    SCI,
    "https://advances.sciencemag.org/content/4/2/eaao7228.full"
);

pub(
    "B.P. Abbott et al.  First low-frequency Einstein@Home all-sky search for continuous gravitational waves in Advanced LIGO data.  Phys. Rev. D 96, 122004",
    "2017",
    JOURNAL,
    SCI,
    "https://link.aps.org/pdf/10.1103/PhysRevD.96.122004"
);

pub(
    "Andrew J. Westphal et al.  Evidence for interstellar origin of seven dust particles collected by the Stardust spacecraft.  Science, Vol. 345 no. 6198 pp. 786-791",
    "15 August 2014",
    JOURNAL,
    SCI,
    "http://www.sciencemag.org/content/345/6198/786.abstract?sid=8109be80-2d78-416b-8d51-9b0888a5d902"
);

pub(
    "David R. Frank et al.  Stardust Interstellar Preliminary Examination II: Curating the interstellar dust collector, picokeystones, and sources of impact tracks.  Meteoritics & Planetary Science 49(9), pp. 1522-1547",
    "Sept. 2014",
    JOURNAL,
    SCI,
    "https://onlinelibrary.wiley.com/doi/full/10.1111/maps.12147"
);

pub(
    "George J. Flynn et al.  Stardust Interstellar Preliminary Examination VII: Synchrotron X-ray fluorescence analysis of six Stardust interstellar candidates measured with the Advanced Photon Source 2-ID-D microprobe.  Meteoritics & Planetary Science 49(9), pp. 1626-1644",
    "Sept. 2014",
    JOURNAL,
    SCI,
    "https://onlinelibrary.wiley.com/doi/full/10.1111/maps.12144"
);

pub(
    "H.A. Bechtel et al.  Stardust Interstellar Preliminary Examination III: Infrared spectroscopic analysis of interstellar dust candidates.  Meteoritics & Planetary Science 49(9)",
    "Sept. 2014",
    JOURNAL,
    SCI,
    "https://onlinelibrary.wiley.com/doi/full/10.1111/maps.12125"
);

pub(
    "R.M Stroud et al.  Stardust Interstellar Preliminary Examination XI: Identification and elemental analysis of impact craters on Al foils from the Stardust Interstellar Dust Collector.  Meteoritics & Planetary Science 49(9)",
    JOURNAL,
    SCI,
    "https://onlinelibrary.wiley.com/doi/full/10.1111/maps.12136"
);
pub(
    "Frank Brenker et al. Stardust Interstellar Preliminary Examination V: XRF analyses of interstellar dust candidates at ESRF ID 13.  Meteoritics & Planetary Science 49(9)",
    "Sept. 2014",
    JOURNAL,
    SCI,
    "https://onlinelibrary.wiley.com/doi/full/10.1111/maps.12206https://onlinelibrary.wiley.com/doi/full/10.1111/maps.12206"
);

pub(
    "Alexandre S Simionovic et al.  Stardust Interstellar Preliminary Examination VI: Quantitative elemental analysis by synchrotron X-ray fluorescence nanoimaging of eight impact features in aerogel. Meteoritics & Planetary Science 49(9), pp. 1612-1625",
    "Sept. 2014",
    JOURNAL,
    SCI,
    "https://onlinelibrary.wiley.com/doi/full/10.1111/maps.12208"
);

pub(
    "Andrew J. Westphal et al.  Coordinated Microanalyses of Seven Particles of Probable Interstellar Origin from the Stardust Mission.  Microscopy and Microanalysis 20(S3). pp. 1692-1693",
    "August 2014",
    JOURNAL,
    SCI
);

pub(
    "EJ Korpela, DP Anderson, R Bankay, J Cobb, G Foster, A Howard, M Lebofsky, G Marcy, A Parsons, A Siemion, J von Korff, D Werthimer, KA Douglas.  SETI with Help from Five Million Volunteers: The Berkeley SETI Efforts. Astronomical Society of the Pacific",
    "2009",
    CONF,
    SCI,
    "https://authors.library.caltech.edu/78772/1/2009ASPC__420__431K.pdf"
);

pub(
    "Anna L. Butterworth et al. Stardust Interstellar Preliminary Examination IV: Scanning transmission X-ray microscopy analyses of impact features in the Stardust Interstellar Dust Collector.  Meteoritics & Planetary Science 49(9), pp. 1562-1593",
    "Sept. 2014",
    JOURNAL,
    SCI,
    "https://onlinelibrary.wiley.com/doi/full/10.1111/maps.12220"
);

pub(
    "Veerle J. Sterken et al.  Stardust Interstellar Preliminary Examination X: Impact speeds and directions of interstellar grains on the Stardust dust collector.  Meteoritics & Planetary Science 49(9), pp. 1680-1697",
    "Sept. 2014",
    JOURNAL,
    SCI,
    "https://onlinelibrary.wiley.com/doi/full/10.1111/maps.12219"
);

pub(
    "Andrew J. Westphal et al.  Stardust interstellar preliminary examination I: identification of tracks in aerogel.  Meteoritics & Planetary Science 49(9), pp. 1509-1521",
    "Sept. 2014",
    JOURNAL,
    SCI,
    "https://onlinelibrary.wiley.com/doi/pdf/10.1111/maps.12168"
);

pub(
    "Oded Nov, Ofer Arazy, David Anderson.  Scientists@Home: What Drives the Quantity and Quality of Online Citizen Science Participation?  PLOS One",
    "April 1 2014",
    JOURNAL,
    BOINC,
    "https://journals.plos.org/plosone/article?id=10.1371/journal.pone.0090375"
);

pub(
    "Holger J. Pletsch et al.  Einstein@ Home discovery of four young gamma-ray pulsars in Fermi LAT data.  The Astrophysical Journal Letters 779(1)",
    "Nov. 26, 2013",
    JOURNAL,
    SCI,
    "https://iopscience.iop.org/article/10.1088/2041-8205/779/1/L11/pdf"
);

pub(
    "B. Knispel et al.  Einstein@Home Discovery of 24 Pulsars in the Parkes Multi-beam Pulsar Survey.  The Astrophysical Journal Letters, 774(2)",
    "August 2013",
    JOURNAL,
    SCI,
    "https://iopscience.iop.org/article/10.1088/0004-637X/774/2/93"
);

pub(
    "B. Allen et al.  The Einstein@Home Search for Radio Pulsars and PSR J2007+2722 Discovery.  The Astrophysical Journal 773(2)",
    "July 2013",
    JOURNAL,
    SCI,
    "https://iopscience.iop.org/article/10.1088/0004-637X/773/2/91"
);

pub(
    "J. Aasi et al.  Einstein@Home all-sky search for periodic gravitational waves in LIGO S5 data.  Phys. Rev. D 87, 042001",
    "2013",
    JOURNAL,
    SCI,
    "https://link.aps.org/pdf/10.1103/PhysRevD.87.042001"
);

pub(
    "Eric Korpela, Vishal Gajjar, Jeff Cobb, David Anderson, Dan Werthimer.  SETI@ home analysis of observations of 220 nearby stars.  42nd COSPAR Scientific Assembly",
    "July 2018",
    CONF,
    SCI
);

pub(
    "J. Von Korff, P. Demorest, E. Heien, E. Korpela, D. Werthimer, J. Cobb, M. Lebofsky, D. Anderson, B. Bankay, and A. Siemion.  Astropulse: A Search for Microsecond Transient Radio Signals Using Distributed Computing. I. Methodology.  The Astrophysical Journal, 767(1)",
    "22 March 2013",
    JOURNAL,
    SCI,
    "http://arxiv.org/abs/1211.1338"
);

pub(
    "Eric Heien, Derrick Kondo, David P. Anderson.  A Correlated Resource Model of Internet End Hosts.  IEEE Transactions on Parallel and Distributed Systems 23(6), p. 977-984",
    "June 2012",
    JOURNAL,
    BOINC
);

pub(
    "B. Knispel et al.  Arecibo PALFA Survey and Einstein@Home: Binary Pulsar Discovery by Volunteer Computing.  The Astrophysical Journal Letters, 732,1",
    "April 2011",
    JOURNAL,
    SCI,
    "https://iopscience.iop.org/article/10.1088/2041-8205/732/1/L1/pdf"
);

pub(
    "Oded Nov, Ofer Arazy, David Anderson.  Dusting for science: motivation and participation of digital citizen science volunteers. Proceedings of the 2011 iConference. pp. 68-74",
    CONF,
    BOINC,
    "http://oferarazy.com/PDF/Dusting%20for%20Science%20Motivation%20and%20Participation%20of%20Digital%20Citizen%20Science%20Volunteers.pdf"
);

pub(
    "Bahman Javadi, Derrick Kondo, Jean-Marc Vincent, and David P. Anderson.  Discovering Statistical Models of Availability in Large Distributed Systems: An Empirical Study of SETI@home.  IEEE Transactions on Parallel and Distributed Systems 22(11) p. 1896-1903",
    "Nov. 2011",
    JOURNAL,
    BOINC,
    "http://mescal.imag.fr/membres/derrick.kondo/pubs/javadi_tpds10.pdf"
);

pub(
    "Eric J Korpela, Andrew PV Siemion, Dan Werthimer, Matt Lebofsky, Jeff Cobb, Steve Croft, David Anderson.  The next phases of SETI@ home.  Instruments, Methods, and Missions for Astrobiology XVII (9606)",
    "Sept. 11, 2015",
    CONF,
    SCI
);

pub(
    "Wenjing Wu, Gang Chen, Wenxiao Kan, David Anderson, Francois Grey.  Harness public computing resources for protein structure prediction computing.  Proc. of the International Symposium on Grids and Clouds (ISGC)",
    "March 17, 2013",
    CONF,
    BOINC,
    "https://pos.sissa.it/179/037/pdf"
);

pub(
    "Eric J Korpela, Jeff Cobb, Matt Lebofsky, Andrew Siemion, Joshua Von Korff, Robert C Bankay, Dan Werthimer, David Anderson.  Candidate Identification and Interference Removal in SETI@ home.  Communication with Extraterrestrial Intelligence (CETI), pp. 37-44",
    "April 1, 2011",
    BOOK,
    SCI,
    "https://arxiv.org/pdf/1109.1595"
);

pub(
    "Eric J Korpela, David P Anderson, Robert Bankay, Jeff Cobb, Andrew Howard, Matt Lebofsky, Andrew PV Siemion, Joshua Von Korff, Dan Werthimer.  Status of the UC-Berkeley SETI efforts.  Instruments, Methods, and Missions for Astrobiology XIV",
    "Sept. 23, 2011",
    CONF,
    SCI,
    "https://arxiv.org/pdf/1108.3134"
);

pub(
    "Andrew Siemion et al.  New SETI sky surveys for radio pulses.  Acta Astronautica 67(11-12). pp. 1342-1349",
    "Dec. 1, 2010",
    JOURNAL,
    SCI,
    "https://arxiv.org/pdf/0811.3046"
);

pub(
    "Oded Nov, Ofer Arazy, and David Anderson.  Scientists@Home and in the Backyard: Understanding the Motivations of Contributors to Digital Citizen Science</a>.  Economics of Networks eJournal.  Vol. 2, No. 108",
    "10 Sep 2010",
    JOURNAL,
    BOINC,
    "http://faculty.poly.edu/~onov/Citizen%20science%20motivations%20V1.pdf"
);

pub(
    "B. Knispel et al. (41 authors).  Pulsar Discovery by Global Volunteer Computing.  Science, Vol. 329. no. 5997, p. 1305",
    "10 September 2010",
    JOURNAL,
    SCI,
    "http://www.sciencemag.org/cgi/content/full/329/5997/1305"
);

pub(
    "I. Buch, M.J. Harvey, T. Giorgino, D.P. Anderson, and G. De Fabritiis.  High-Throughput All-Atom Molecular Dynamics Simulations Using Distributed Computing.  J. Chem. Inf. Model, 50 (3) pp 397-403",
    "March 2010",
    JOURNAL,
    SCI,
    "http://kasparov.upf.edu/compscience/wp-content/uploads/2018/12/gpugrid.pdf"
);

pub(
    "Abbott, B.P. et al. (504 authors).  Einstein@Home search for periodic gravitational waves in early S5 LIGO data.  Phys. Rev. D 80, 042003",
    "2009",
    JOURNAL,
    SCI,
    "https://link.aps.org/pdf/10.1103/PhysRevD.80.042003"
);

pub(
    "Eric M. Heien, David P. Anderson, and Kenichi Hagihara.  Computing Low Latency Batches with Unreliable Workers in Volunteer Computing Environments.  Journal of Grid Computing 7(4) p. 501-518",
    "Dec. 2009",
    JOURNAL,
    BOINC,
    "https://link.springer.com/content/pdf/10.1007/s10723-009-9131-6.pdf"
);

pub(
    "Trilce Estrada, Michela Taufer, David Anderson.  Performance Prediction and Analysis of BOINC Projects: An Empirical Study with EmBOINC.  Journal of Grid Computing 7(4) p. 537-554",
    "Dec. 2009",
    JOURNAL,
    BOINC,
    "https://link.springer.com/content/pdf/10.1007/s10723-009-9126-3.pdf"
);

pub(
    "B. Abbott et al.  Einstein@Home search for periodic gravitational waves in LIGO S4 data.  Physical Review D, 79:022001",
    "2009",
    JOURNAL,
    SCI,
    "https://link.aps.org/pdf/10.1103/PhysRevD.79.022001"
);

pub(
    "Kevin A Douglas, David P Anderson, Robert Bankay, Jeff Cobb, Eric J Korpela, Matt Lebofsky, Joshua Von Korff, Dan Werthimer.  Spinoff successes of the SETI@ home project.  Astrobiology 7(3)",
    "June 1, 2007",
    JOURNAL,
    SCI
);

pub(
    "D.P. Anderson, J. Cobb, E. Korpela, M. Lebofsky, and D. Werthimer.  SETI@home: An experiment in public-resource computing.  Communications of the ACM, Vol. 45 No. 11, pp. 56-61",
    "Nov. 2002",
    JOURNAL,
    SCI,
    "https://disco.ethz.ch/courses/fs10/seminar/paper/michael-7.pdf"
);

pub(
    "Korpela, E., Werthimer, D., Anderson, D., Cobb, J., and Lebofsky, M., SETI@home: Massively Distributed Computing for SETI, Computing in Science and Engineering, 3, 1, p. 78-83",
    "Jan 1 2001",
    JOURNAL,
    SCI,
    "https://d1wqtxts1xzle7.cloudfront.net/32641945/CISE.pdf?1388250465=&response-content-disposition=inline%3B+filename%3DCise.pdf&Expires=1612167290&Signature=JzPguU1Y3tH0~9bPEdxPe~oxY5UAQp~f9qjDCcnT9KaxCaZi0LAZj-bkaqrhNVDZtxOxH-WeDFf9vviP3tLOe67X7yCxVQsg3hN-oYk~iNqFxFFP3eaSV-NePKswdv1hjSrYkuFL0GaV944EVKStZ1kJg7twNmdFKVv5G2XZjoClBMTZuOaUsogizHKq8X-22Bo-3JM0t4Z0N9yYUnqawdsOwAjdVKF2ANOKN3s5Iwef6RtD8SUTXZUKK7ZUOao3ndHXZqyaUH8fkfA-eIAmT6QwMVsZHtGb4H0afFw~RYMKbpEMeWgLwZv~-HxuOnxVEpe0hlWhp7yI0NChGFBxbA__&Key-Pair-Id=APKAJLOHF5GGSLRBV4ZA"
);

pub(
    "D.P. Anderson, Device Reservation in Audio/Video Editing Systems.
ACM Transactions on Computer Systems 15(2) p. 111-133",
    "May 1997",
    JOURNAL,
    CM
);

pub(
    "D.P. Anderson, Metascheduling for Continuous Media.  ACM Transactions on Computer Systems 11(3), p. 226-252",
    "Aug. 1993",
    JOURNAL,
    CM,
    "https://citeseerx.ist.psu.edu/viewdoc/download?doi=10.1.1.87.1883&rep=rep1&type=pdf"

);

pub(
    "D.P. Anderson, Y. Osawa and R. Govindan, A File System for Continuous Media.  ACM Transactions on Computer Systems, 10(4), p. 311-337",
    "Nov. 1992",
    JOURNAL,
    CM,
    "http://www.cs.uccs.edu/~cs525/vod/ACMTOCS_ContinuousMediaFileSystemp311-anderson.pdf"
);

pub(
    "D.P. Anderson and P. Chan. Comet: a toolkit for multiuser audio/video applications. 1992 12th International Conference on Distributed Computing System",
    "Jan. 1, 1992",
    CONF,
    CM
);

pub(
    "D.P. Anderson and P. Chan, Toolkit Support for Multiuser Audio/Video Applications. Computer Communications, 15(6) p. 403-408",
    "July 1992",
    JOURNAL,
    CM,
    "https://link.springer.com/content/pdf/10.1007/3-540-55639-7_20.pdf"
);

pub(
    "D.P. Anderson and G. Homsy, A Continuous Media I/O Server and its Synchronization Mechanism, IEEE Computer",
    "October 1991",
    JOURNAL,
    CM
);

pub(
    "D.P. Anderson and R.J. Kuivila, FORMULA: a Programming Language for Expressive Computer Music, IEEE Computer",
    "June 1991",
    JOURNAL,
    MUSIC,
    "https://boinc.berkeley.edu/anderson/formula_computer.pdf"
);

pub(
    "S. Tzou and D.P. Anderson, The Performance of Message-Passing Using Restricted Virtual Memory Remapping, Software - Practice & Experience 21, 3",
    "March 1991",
    JOURNAL,
    MISC,
    "http://citeseerx.ist.psu.edu/viewdoc/download?doi=10.1.1.14.9697&rep=rep1&type=pdf"
);

pub(
    "D. Hernek and D.P. Anderson, Efficient Automated Protocol Implementation Using RTAG, Software - Practice & Experience 20, 9 p. 869- 885",
    "September 1990",
    JOURNAL,
    MISC,
    "https://www2.eecs.berkeley.edu/Pubs/TechRpts/1989/CSD-89-526.pdf"
);

pub(
    "D.P. Anderson and R.J. Kuivila, A System for Computer Music Performance,
ACM Transactions on Computer Systems 8, 1, 56-82",
    "February 1990",
    JOURNAL,
    MUSIC,
    "https://www.cs.cmu.edu/~music/cmsip/readings/p56-anderson.pdf"
);

pub(
    "D.P. Anderson and R.J. Kuivila, Continuous Abstractions for Discrete Event Languages, Computer Music Journal 13, 3, 11-23",
    "Sept. 1989",
    JOURNAL,
    MUSIC
);

pub(
    "D.P. Anderson, Automated Protocol Implementation with RTAG, IEEE Transactions on Software Engineering 14(3), 291-300",
    "March 1988",
    JOURNAL,
    MISC,
    "http://www-sop.inria.fr/members/Didier.Parigot/pmwiki/Didier/uploads/Wiki/Anderson88.pdf"
);

pub(
    "D.P. Anderson and R.J. Kuivila, Accurately Timed Generation of Discrete Musical Events, Computer Music Journal 10, 3, 48-56",
    "Sept. 1986",
    JOURNAL,
    MUSIC
);

pub(
    "D.P. Anderson, Efficient Algorithms for Automatic Viewer Orientation, Computers and Graphics 9, 4, 407-413",
    "1985",
    JOURNAL,
    MISC
);

pub(
    "D.P. Anderson, Techniques for Reducing Pen Plotting Time, ACM Transactions on Graphics 2, 197- 212",
    "1983",
    JOURNAL,
    MISC
);

pub(
    "D.P. Anderson, An Orientation Method for Central Projection Programs, Computers and Graphics 6 , 35-38",
    "1982",
    JOURNAL,
    MISC
);

pub(
    "D.P. Anderson, Hidden Line Elimination in Projected Grid Surfaces, ACM Transactions on Graphics 1(4), 274-288",
    "Oct. 1, 1982",
    JOURNAL,
    MISC,
    "https://apps.dtic.mil/sti/pdfs/ADA124348.pdf"
);

pub(
    "Andrew J. Westphal et al.  Final reports of the stardust interstellar preliminary examination.  Meteoritics & Planetary Science 49(9), pp. 1720-1733",
    "Sept. 2014",
    JOURNAL,
    SCI,
    "https://onlinelibrary.wiley.com/doi/full/10.1111/maps.12221"
);

pub(
    "Zack Gainsforth et al. Stardust Interstellar Preliminary Examination VIII: Identification of crystalline material in two interstellar candidates.  Meteoritics & Planetary Science 49(9)",
    "Sept. 2014",
    JOURNAL,
    SCI,
    "https://onlinelibrary.wiley.com/doi/pdfdirect/10.1111/maps.12148"
);

pub(
    "Andrew J. Westphal et al.  Final reports of the Stardust ISPE: seven probable interstellar dust particles.  45th Lunar and Planetary Science Conference.  The Woodlands, Texas. p.2269",
    "17-21 March, 2014",
    CONF,
    SCI
);

pub(
    "Jesse F. Lawrence et al.  MEMS accelerometers and distributed sensing for rapid earthquake characterization.  Bulletin of the Seismological Society of America (BSSA)",
    "2014",
    JOURNAL,
    SCI
);

pub(
    "Bahman Javadi, Kenan Matawie and David Anderson.
Modeling and Analysis of Resources Availability in Volunteer Computing Systems.
32nd IEEE International Performance Computing and Communications Conference
(IPCCC 2013), San Diego CA",
    "December 6-8, 2013",
    CONF,
    BOINC,
    "https://citeseerx.ist.psu.edu/viewdoc/download?doi=10.1.1.712.4765&rep=rep1&type=pdf"
);

pub(
    "Hien Nguyen, Eshwar Rohit, Jaspal Subhlok, Edgar Gabriel, Qian Wang, Margaret S. Cheung and David Anderson.  An Execution Environment for Robust Parallel Computing on Volunteer PC Grids.  The 41st International Conference on Parallel Processing, Pittsburgh, PA",
    "September 10-13, 2012",
    CONF,
    BOINC,
    "https://citeseerx.ist.psu.edu/viewdoc/download?doi=10.1.1.299.4461&rep=rep1&type=pdf"
);

pub(
    "Oded Nov, Ofer Arazy, and David Anderson.  Technology-Mediated Citizen Science Participation: A Motivational Model. Fifth International AAAI Conference on Weblogs and Social Media (ICWSM 2011), Barcelona",
    "July 17-21, 2011",
    CONF,
    BOINC,
    "https://ojs.aaai.org/index.php/ICWSM/article/download/14113/13962"
);


pub(
    "Eric Heien, Derrick Kondo, David P. Anderson.  Correlated Resource Models of Internet End Hosts.  31st International Conference on Distributed Computing Systems (ICDCS), Minneapolis, Minnesota, USA",
    "June 20-24, 2011",
    CONF,
    BOINC,
    "https://arxiv.org/pdf/1011.5568"
);

pub(
    "Eshwar Pedamallu, Hien Nguyen, Nagarajan Kanna, Qian Wang, Jaspal Subhlok, Edgar Gabriel, Margaret Cheung and David Anderson.  A Robust Communication Framework for Parallel Execution on Volunteer PC Grids.  The 11th IEEE/ACM International Symposium on Cluster, Cloud, and Grid Computing, Newport Beach",
    "May 23-26, 2011",
    CONF,
    BOINC,
    "https://www.researchgate.net/profile/Jaspal_Subhlok/publication/224246694_A_Robust_Communication_Framework_for_Parallel_Execution_on_Volunteer_PC_Grids/links/00b7d52267880efb97000000.pdf"
);

pub(
    "Sangho Yi, Emmanuel Jeannot, Derrick Kondo and David Anderson.  Towards Real-Time, Volunteer Distributed Computing.  The 11th IEEE/ACM International Symposium on Cluster, Cloud, and Grid Computing, Newport Beach",
    "May 23-26, 2011",
    CONF,
    BOINC,
    "https://www.labri.fr/perso/ejeannot/publications/ccgrid11.pdf"
);

pub(
    "David P. Anderson.  Emulating Volunteer Computing Scheduling Policies.  Fifth Workshop on Desktop Grids and Volunteer Computing Systems (PCGrid 2011), Anchorage (Alaska)",
    "May 20, 2011",
    CONF,
    BOINC,
    "https://boinc.berkeley.edu/boinc_papers/pcgrid_11/p2.pdf"
);


pub(
    "Yi, Sangho, Derrick Kondo, and David P. Anderson.  Toward Real-time, Many-Task Applications on Large Distributed Systems.  The Sixteenth International Conference on Parallel Computing, Naples, Italy",
    "Aug 31-Sept 3, 2010",
    CONF,
    BOINC,
    "https://link.springer.com/content/pdf/10.1007/978-3-642-15277-1_35.pdf"
);

pub(
    "Travis Desell, David Anderson, Malik Magdon-Ismail, Heidi Newberg, Boleslaw Szymanski and Carlos Varela.  An Analysis of Massively Distributed Evolutionary Algorithms.  2010 IEEE Congress on Evolutionary Computation, Barcelona",
    "July 18-23, 2010",
    CONF,
    BOINC,
    "https://www.researchgate.net/profile/Boleslaw_Szymanski/publication/224177790_An_analysis_of_massively_distributed_evolutionary_algorithms/links/00463520d0dfb04b14000000.pdf"
);

pub(
    "Travis Desell, Malik Magdon-Ismail, Boleslaw Szymanski, Carlos Varela, Heidi Newberg, and David Anderson.  Validating Evolutionary Algorithms on Volunteer Computing Grids.  The 10th IFIP international conference on Distributed Applications and Interoperable Systems, Amsterdam",
    "June 7-10, 2010",
    CONF,
    BOINC,
    "https://link.springer.com/content/pdf/10.1007/978-3-642-13645-0_3.pdf"
);

pub(
    "Oded Nov, David P. Anderson, and Ofer Arazy.  Volunteer Computing: A Model of the Factors Determining Contribution to Community-based Scientific Research.  Proceedings of the 19th international conference on World wide web, Raleigh NC, pp. 741-750",
    "April 26-30, 2010",
    CONF,
    BOINC,
    "http://oferarazy.com/PDF/Volunteer%20computing%20a%20model%20of%20the%20factors%20determining%20contribution%20to%20community%20based%20scientific%20research.pdf"
);

pub(
    "Artur Andrzejak, Derrick Kondo and David P. Anderson.  Exploiting Non-Dedicated Resources for Cloud Computing.  12th IEEE/IFIP Network Operations & Management Symposium (NOMS 2010), Osaka, Japan",
    "April 19-23, 2010",
    CONF,
    BOINC,
    "https://citeseerx.ist.psu.edu/viewdoc/download?doi=10.1.1.631.1477&rep=rep1&type=pdf"
);

pub(
    "David P. Anderson. Volunteer computing: the ultimate cloud.  XRDS: Crossroads, The ACM Magazine for Students.  16(3). pp. 7-10",
    "March 1, 2010",
    MAG,
    BOINC,
    "https://boinc.berkeley.edu/boinc_papers/crossroads.pdf"
);

pub(
    "Oded Nov, Ofer Arazy, and David P. Anderson.  Crowdsourcing for science: understanding and enhancing SciSourcing contribution.  The Changing Dynamics of Scientific Collaborations, workshop at CSCW 2010, Savannah GA",
    "Feb. 7 2010",
    CONF,
    BOINC,
    "https://www.researchgate.net/profile/Ofer_Arazy/publication/228986857_Crowdsourcing_for_science_understanding_and_enhancing_SciSourcing_contribution/links/09e41509bfc3a31331000000/Crowdsourcing-for-science-understanding-and-enhancing-SciSourcing-contribution.pdf"
);

pub(
    "Nagarajan Kanna, Jaspal Subhlok, Edgar Gabriel, Eshwar Rohit and David Anderson.  A Communication Framework for Fault-tolerant Parallel Execution.  The 22nd International Workshop on Languages and Compilers for Parallel Computing, Newark, Delaware",
    "Oct 8-10, 2009",
    CONF,
    BOINC,
    "https://citeseerx.ist.psu.edu/viewdoc/download?doi=10.1.1.158.3180&rep=rep1&type=pdf"
);

pub(
    "Travis Desell, Anthony Waters, Malik Magdon-Ismail, Boleslaw Szymanski, Carlos Varela, Matthew Newby, Heidi Newberg, Andreas Przystawik and David Anderson.  Accelerating the MilkyWay@Home volunteer computing project with GPUs.  In 8th International Conference on Parallel Processing and Applied Mathematics (PPAM 2009), Wroclaw, Poland.  Lecture Notes in Computer Science, Vol. 6067 Wyrzykowski, R.; Dongarra, J.; Karczewski, K.; Wasniewski, J. (Eds.) 1st Edition., 2010, XXIV, 628 p., Softcover",
    "September 2009",
    CONF,
    BOINC,
    "http://www.eecis.udel.edu/~cavazos/cisc879-spring2012/papers/ppam.09.pdf"
);

pub(
    "Nagarajan Kanna, Jaspal Subhlok, Edgar Gabriel, Margaret Cheung, David Anderson.  Redundancy tolerant communication on volatile nodes.  Technical Report UH-CS-08-17, University of Houston",
    "Dec. 5, 2008",
    TR,
    BOINC,
    "https://uh.edu/nsm/_docs/cosc/technical-reports/2008/08_17.pdf"
);

pub(
    "Bahman Javadi, Derrick Kondo, Jean-Marc Vincent, David P. Anderson.  Mining for Availability Models in Large-Scale Distributed Systems: A Case Study of SETI@home.  17th Annual Meeting of the IEEE/ACM International Symposium on Modelling, Analysis and Simulation of Computer and Telecommunication Systems, London",
    "Sept 21-23, 2009",
    CONF,
    BOINC,
    "http://citeseerx.ist.psu.edu/viewdoc/download?doi=10.1.1.702.5701&rep=rep1&type=pdf"
);

pub(
    "Trilce Estrada, Michela Taufer, Kevin Reed, David Anderson.  EmBOINC: An Emulator for Performance Analysis of BOINC Projects.  2009 IEEE International Symposium on Parallel & Distributed Processing, Rome",
    "May 29, 2009",
    CONF,
    BOINC,
    "https://www.researchgate.net/profile/Michela_Taufer/publication/224561544_EmBOINC_An_emulator_for_performance_analysis_of_BOINC_projects/links/00b4951a5183f99b0c000000/EmBOINC-An-emulator-for-performance-analysis-of-BOINC-projects.pdf"
);

pub(
    "Derrick Kondo, Bahman Javadi, Paul Malecot, Franck Cappello and David Anderson.  Cost-Benefit Analysis of Cloud Computing versus Desktop Grids.  18th International Heterogeneity in Computing Workshop, Rome",
    "May 25 2009",
    CONF,
    BOINC,
    "https://www.researchgate.net/profile/Bahman_Javadi/publication/224561492_Cost-Benefit_Analysis_of_Cloud_Computing_versus_Desktop_Grids/links/00b7d523ba5bef33e1000000.pdf"
);

pub(
    "David P. Anderson and Kevin Reed.  Celebrating Diversity in Volunteer Computing.  42nd Hawaii International Conference on System Sciences (HICSS), (Best Paper Award)",
    "January 5-8, 2009",
    CONF,
    BOINC,
    "https://boinc.berkeley.edu/boinc_papers/hicss_08/hicss_08.pdf"
);

pub(
    "Artur Andrzejak, Derrick Kondo, and David P. Anderson.  Ensuring Collective Availability in Volatile Resource Pools via Forecasting.  19th IFIP/IEEE International Workshop on Distributed Systems: Operations and Management (DSOM 2008), Samos Island, Greece",
    "September 22-26, 2008",
    CONF,
    BOINC,
    "https://link.springer.com/content/pdf/10.1007/978-3-540-87353-2_12.pdf"
);

pub(
    "Derrick Kondo, Artur Andrzejak, and David P. Anderson.  On Correlated Availability in Internet-Distributed Systems.  9th IEEE/ACM International Conference on Grid Computing (Grid 2008), Tsukuba, Japan",
    "Sept 29-Oct 1, 2008",
    CONF,
    BOINC,
    "https://hal.inria.fr/inria-00279991/document"
);

pub(
    "D. Kondo, D.P. Anderson, and J. McLeod VII.  Performance Evaluation of Scheduling Policies for Volunteer Computing.  3rd IEEE International Conference on e-Science and Grid Computing, Bangalore, India",
    "December 10-13, 2007",
    CONF,
    BOINC,
    "https://hal.inria.fr/inria-00164599/file/client_sch_eval.pdf"
);

pub(
    "David P. Anderson.  Volunteer computing: Planting the flag.  Proceedings of the PCGrid 2007 Workshop, Long Beach, CA, USA",
    "March 30, 2007",
    CONF,
    BOINC
);

pub(
    "D.P. Anderson and J. McLeod VII.  Local Scheduling for Volunteer Computing.  Workshop on Large-Scale, Volatile Desktop Grids (PCGrid 2007) held in conjunction with the IEEE International Parallel & Distributed Processing Symposium (IPDPS), Long Beach",
    "March 30, 2007",
    CONF,
    BOINC,
    "http://citeseerx.ist.psu.edu/viewdoc/download?doi=10.1.1.421.1485&rep=rep1&type=pdf"
);

pub(
    "Westphal, A.J., et al.  Search for Contemporary Interstellar Dust in the Stardust Collector, 38th Lunar and Planetary Science Conference, League City, TX. p. 1457",
    "March 12-16, 2007",
    CONF,
    SCI
);

pub(
    "T. Estrada, D. Flores, M. Taufer, P. Teller, A. Kerstens, and D. Anderson.  The Effectiveness of Threshold-based Scheduling Policies.  2nd IEEE International Conference on e-Science and Grid Computing, Netherlands",
    "Dec. 4-6, 2006",
    CONF,
    BOINC,
    "https://scholarworks.utep.edu/cgi/viewcontent.cgi?article=1191&context=cs_techrep"
);

pub(
    "D.P. Anderson, C. Christensen, and B. Allen.  Designing a Runtime System for Volunteer Computing.  Supercomputing '06 (The International Conference for High Performance Computing, Networking, Storage and Analysis), Tampa",
    "November 2006",
    CONF,
    BOINC,
    "https://www.researchgate.net/profile/Carl_Christensen5/publication/220782853_Grid_resource_management---Designing_a_runtime_system_for_volunteer_computing/links/0deec51c0b1e5602e2000000.pdf"
);

pub(
    "D.P. Anderson and G. Fedak.  The Computational and Storage Potential of Volunteer Computing.  IEEE/ACM International Symposium on Cluster Computing and the Grid, Singapore",
    "May 16-19, 2006",
    CONF,
    BOINC,
    "https://arxiv.org/pdf/cs/0602061"
);

pub(
    "Rattei, T., W. Mathias, R. Arnold, D.P. Anderson, W. Mewes.  Using public resource computing and systematic pre-calculation for large scale sequence analysis GCCB'06: Proceedings of the 2006 international conference on Distributed, high-performance and grid computing in computational biology, pp 11-18",
    "2006",
    CONF,
    BOINC
);

pub(
    "AJ Westphal, J Von Korff, DP Anderson, A Alexander, B Betts, DE Brownlee, AL Butterworth, N Craig, Z Gainsforth, B Mendez, T See, CJ Snead, R Srama, S Tsitrin, J Warren, M Zolensky.  Stardust@ home: virtual microscope validation and first results.  37th Annual Lunar and Planetary Science Conference",
    "March 2006",
    CONF,
    SCI
);

pub(
    "Andrew J Westphal, Anna L Butterworth, Christopher J Snead, Nahide Craig, David Anderson, Steven M Jones, Donald E Brownlee, Richard Farnsworth, Michael E Zolensky.  Stardust@ home: a massively distributed public search for interstellar dust in the stardust interstellar dust collector.  36th Annual Lunar and Planetary Science Conference",
    "March 2005",
    CONF,
    SCI
);

pub(
    "D.P. Anderson, E. Korpela, and R. Walton.  High-Performance Task Distribution for Volunteer Computing.  1st IEEE International Conference on e-Science and Grid Computing, Melbourne pp. 196-203",
    "Dec. 2005",
    CONF,
    BOINC,
    "http://www.di.fc.ul.pt/~mjc/artigos-CP/High-Performance%20Task%20Distribution%20for%20Volunteer%20Computing.pdf"
);

pub(
    "M. Taufer, P.J. Teller, D.P. Anderson, and C.L. Brooks III.  Metrics for Effective Resource Management in Global Computing Environments.  in 1st IEEE International Conference on e-Science and Grid Computing, Melbourne, pp. 204-211",
    "Dec. 2005",
    CONF,
    BOINC,
    "https://www.academia.edu/download/31184758/metrics_for_effective_resource_management_in_global_computing_environments.pdf"
);

pub(
    "M. Taufer, D. Anderson, P. Cicotti, C.L. Brooks III.  Homogeneous Redundancy: a Technique to Ensure Integrity of Molecular Simulation Results Using Public Computing.  Heterogeneous Computing Workshop, International Parallel and Distributed Processing Symposium 2005, Denver, CO",
    "April 4-8, 2005",
    CONF,
    BOINC,
    "https://www.academia.edu/download/31184752/W01_HCW_05.pdf"
);

pub(
    "David P. Anderson.  BOINC: A System for Public-Resource Computing and Storage.  5th IEEE/ACM International Workshop on Grid Computing, Pittsburgh, USA, pp 1-7",
    "November 8, 2004",

    CONF,
    BOINC,
    "http://www2.cs.uh.edu/~jaspal/cosc7397/06papers/boinc.pdf"
);

pub(
    "D.P. Anderson. Public Computing: Reconnecting People to Science. Conference on Shared Knowledge and the Web.  Residencia de Estudiantes, Madrid",
    "Nov. 17-19, 2003",
    CONF,
    BOINC,
    "http://webpage.pace.edu/tm76071w/gridcomputing/boinc2.pdf"
);

pub(
    "Eric J Korpela, Jeff Cobb, Steve Fulton, Matt Lebofsky, Eric Heien, Eric Person, Paul Demorest, Robert Bankay, David Anderson, Dan Werthimer.  Three Years of SETI@ home: A Status Report.  Symposium-International Astronomical Union",
    "2004",
    CONF,
    SCI,
    "http://adsabs.harvard.edu/pdf/2004IAUS..213..419K"
);

pub(
    "D.P. Anderson, Eric Korpela, Jeff Cobb, Bob Bancay.  A general distributed computing platform for SETI.  Bioastronomy 2002",
    "2002",
    CONF,
    BOINC
);

pub(
    "Werthimer, D., Anderson, D., Bowyer, C. S., Cobb, J., Heien, E., Korpela, E., Lampton, M., Lebofsky, M., Marcy, G.W., McGarry, M., & Treffers, D.  Berkeley radio and optical SETI programs: SETI@home, SERENDIP, and SEVENDIP, Proc. SPIE, 4273, 104",
    "2001",
    CONF,
    SCI
);

pub(
    "Dan Werthimer, David Anderson, Stuart Bowyer, Jeff Cobb, Eric Korpela, Michael Lampton, Matt Lebofsky, Geoff Marcy, Dick Treffers.  THE BERKELEY SETI PROGRAM: SETI@ HOME, SERENDIP, AND OPTICAL SETI.  Proceedings of the International Astronautical Federation",
    "2000",
    CONF,
    SCI
);

pub(
    "D.P. Anderson, D. Werthimer, J. Cobb, E. Korpela, M. Lebofsky, D. Gedye, W. Sullivan III.  SETI@home: Internet Distributed Computing for SETI.  In Bioastronomy '99 - A New Era in Bioastronomy, ASP Conference Series 213",
    "1999",
    CONF,
    SCI,
    "http://adsabs.harvard.edu/pdf/2000ASPC..213..511A"
);

pub(
    "W.T. Sullivan, III, D.  Werthimer, S. Bowyer, J. Cobb, D. Gedye, D. Anderson.  A new major SETI project based on Project SERENDIP data and 100,000 personal computers.  Proc. of the Fifth Intl. Conf. on Bioastronomy",
    "1997",
    CONF,
    SCI
);

pub(
    "Dean Jacobs, David P Anderson.  Design Issues for Digital Audio Networks.  Audio Engineering Society Conference: 13th International Conference: Computer-Controlled Sound Systems",
    "Dec. 1, 1994",
    CONF,
    CM
);

pub(
    "D.P. Anderson, R.J. Doris, and J.A. Moorer, A Distributed Computer System for Professional Audio, ACM Multimedia '94, San Francisco",
    "Oct. 1994",
    CONF,
    CM
);

pub(
    "D.P. Anderson, J.A. Moorer and J.M. Roth, Performance Issues in Digital Audio Networks, 95th Convention of the Audio Engineering Society, New York",
    "Oct. 7-10, 1993",
    CONF,
    CM
);

pub(
    "D.P. Anderson, R. Doris, J.A. Moorer, J. Reichbach, J. Roth and B. Tellegen, High-Speed Networking for Professional Digital Audio.  Audio Engineering Society UK Conference on Digital Audio Interchange, London",
    "May 1993",
    CONF,
    CM
);

pub(
    "D.P. Anderson, Nimrod Megiddo, and Moni Naor.  The Minimum Reservation Rate Problem in Digital Audio/Video Systems.  2nd Israel Symposium on Theory, Natanya, Israel",
    "June 7-9, 1993",
    CONF,
    CM,
    "https://citeseerx.ist.psu.edu/viewdoc/download?doi=10.1.1.29.6399&rep=rep1&type=pdf"
);

pub(
    "D.P. Anderson and J. Bilmes, MOOD: A Concurrent C++-Based Music Language, International Computer Music Conference, San Jose CA, pp. 147-162",
    "1992",
    CONF,
    MUSIC,
    "https://people.ece.uw.edu/bilmes/p/mypubs/bilmes1992-icmcmood.ps.gz"
);

pub(
    "D.P. Anderson, Y. Osawa and R. Govindan, The Continuous Media File System, Proc. of the USENIX Summer 92 Conference, San Antonio",
    "1992",
    CONF,
    CM
);

pub(
    "David P Anderson, Yoshitomo Osawa, Ramesh Govindan.  Real-time disk storage and retrieval of digital audio/video data.  Technical Report, EECS Dept, UC Berkeley",
    "Aug. 8, 1991",
    TR,
    CM,
    "https://www2.eecs.berkeley.edu/Pubs/TechRpts/1991/CSD-91-646.pdf"
);

pub(
    "R. Govindan and D.P. Anderson, Scheduling and IPC Mechanisms for Continuous Media, 13th Symposium on Operating System Principles, Pacific Grove, CA, 68-80",
    "October 1991",
    CONF,
    CM,
    "https://citeseerx.ist.psu.edu/viewdoc/download?doi=10.1.1.41.8504&rep=rep1&type=pdf"
);

pub(
    "D.P. Anderson and J. Bilmes, Concurrent Real-Time Music in C++, USENIX C++ Workshop, Washington D.C., 147-161",
    "April 22-25, 1991",
    CONF,
    MUSIC
);

pub(
    "D.P. Anderson, L. Delgrossi and R.G. Herrtwich, Process Structure and Scheduling in Real-Time Protocol Implementations, Proc. Kommunikation in Verteilten Systemen",
    "February 1991",
    CONF,
    DASH
);

pub(
    "D.P. Anderson, R. Govindan and G. Homsy, Abstractions for Continuous Media in a Network Window System, International Conference on Multimedia Information Systems, Singapore",
    "Jan 1991",
    CONF,
    CM
);

pub(
    "D.P. Anderson, S. Tzou, R. Wahbe, R. Govindan and M. Andrews, Support for Continuous Media in the DASH System, Proceedings of the 10th International Conference on Distributed Computing Systems, Paris",
    "May 1990",
    CONF,
    CM
);

pub(
    "D.P. Anderson and R.G. Herrtwich, Resource Management for Digital Audio and Video, IEEE Workshop on Real-Time Operating Systems and Software, Charlottesville, 99-103",
    "May 1990",
    CONF,
    CM
);

pub(
    "D.P. Anderson and R.G. Herrtwich, Resource Management in Distributed Multimedia Systems - A Solution for the Internet, IFIP/IEEE Workshop on Distributed Systems: Operations and Management, Berlin",
    "October 1990",
    CONF,
    CM
);

pub(
    "S.E. Lucco and D.P. Anderson, Tarmac: A Language System Substrate Based on Mobile Memory, Proceedings of the 10th International Conference on Distributed Computing Systems, Paris",
    "May 1990",
    CONF,
    MISC,
    "https://www2.eecs.berkeley.edu/Pubs/TechRpts/1989/CSD-89-525.pdf"
);

pub(
    "M. Sullivan and D.P. Anderson, Marionette: a System for Parallel Distributed Programming using a Master/Slave Model, Proc. 9th International Conference on Distributed Systems",
    "June 1989",
    CONF,
    MISC,
    "https://apps.dtic.mil/sti/pdfs/ADA620734.pdf"
);

pub(
    "D.P. Anderson, The Workstation as Global Communication Interface, IEEE Conference on Workstation Operating Systems, Monterey, CA",
    "April 1989",
    CONF,
    DASH
);

pub(
    "D.P. Anderson and R. Wahbe.  A Framework for Multimedia Communication in a General-Purpose Distributed System.  Technical Report No. 89/498, CS Div., EECS Dept., UC Berkeley",
    "March 31, 1989",
    CONF,
    MISC,
    "https://apps.dtic.mil/sti/pdfs/ADA631677.pdf"
);

pub(
    "D.P. Anderson and R.J. Kuivila, Programming Language Constructs for Parallel Musical Computations, 1989 International Computer Music Conference, Columbus, Ohio",
    "Nov. 1989",
    CONF,
    MUSIC
);

pub(
    "D.P. Anderson, A Software Architecture for Network Communication, Proceedings of the 8th International Conference on Distributed Computing Systems, San Jose, California",
    "June 1988",
    CONF,
    DASH,
    "https://apps.dtic.mil/sti/pdfs/ADA197290.pdf"
);

pub(
    "S. Keshav and D.P. Anderson, A Workload Model for Large Distributed File Systems, 19th Annual Pittsburgh Conference on Modeling and Simulation, Pittsburgh PA",
    "May 5-6, 1988",
    CONF,
    MISC,
    "http://svr-sk818-web.cl.cam.ac.uk/keshav/papers/88/filesys_modsim.pdf"
);

pub(
    "D.P. Anderson, D. Ferrari, P.V. Rangan and B. Sartirana, The Empirical Evaluation of a Security-Oriented Datagram Protocol, IFIP Performance '87, Brussels",
    "December 1987",
    CONF,
    DASH,
    "https://apps.dtic.mil/sti/pdfs/ADA619421.pdf"
);

pub(
    "D.P. Anderson, D. Ferrari, P.V. Rangan and B. Sartirana, A Protocol for Secure Communication and its Performance, Proceedings of the 7th International Conference on Distributed Computing Systems, Berlin",
    "September 1987",
    CONF,
    DASH,
    "https://apps.dtic.mil/sti/pdfs/ADA179326.pdf"
);

pub(
    "D.P. Anderson, Synthesizer Management Based on Note Priorities, Proceedings of the 1987 International Computer Music Conference, Urbana-Champaign, 230-237",
    "1987",
    CONF,
    MUSIC
);

pub(
    "D.P. Anderson and P.V. Rangan, High-Performance Interface Architectures for Cryptographic Hardware, Workshop on the Theory and Application of of Cryptographic Techniques, Amsterdam",
    "April 1987",
    CONF,
    DASH,
    "https://link.springer.com/content/pdf/10.1007/3-540-39118-5_27.pdf"
);

pub(
    "D.P. Anderson and P.V. Rangan, A Basis for Secure Communication in Large Distributed Systems, IEEE Symposium on Security and Privacy",
    "April 1987",
    CONF,
    DASH,
    "https://apps.dtic.mil/sti/pdfs/ADA604023.pdf"
);

pub(
    "D.P. Anderson and D. Ferrari, The DASH Project, ACM SIGOPS Workshop on Distributed Systems, Amsterdam",
    "September 1986",
    CONF,
    DASH
);

pub(
    "R.J. Kuivila and D.P. Anderson, Timing Accuracy and Response Time in Interactive Systems, Proceedings of the 1986 International Computer Music Conference, The Hague",
    "1986",
    CONF,
    MUSIC
);

pub(
    "D.P. Anderson and R.J. Kuivila, A Model of Real-Time Computation for Computer Music, Proceedings of the 1986 International Computer Music Conference, The Hague, 35-42",
    "1986",
    CONF,
    MUSIC
);

pub(
    "D.P. Anderson and L.H. Landweber, A Grammar-Based Methodology for Protocol
Specification and Implementation, Proceedings of the Ninth Data Communications
Symposium, 63-70",
    "September 1985",
    CONF,
    MISC,
    "https://minds.wisconsin.edu/bitstream/handle/1793/58662/TR612.pdf?sequence=1"
);

pub(
    "D.P. Anderson, A FORTH Computer Music Programming Environment Design, Proceedings of the 4th Annual Forth Applications Conference, Rochester NY",
    "June 5-9, 1984",
    CONF,
    MUSIC
);

pub(
    "D.P. Anderson and L.H. Landweber, Protocol Specification by Real-Time Attribute Grammars, Proceedings of the IFIPS Fourth International Workshop on Protocol Specification, Testing, and Verification, Skytop, Pennsylvania",
    "June 11-14, 1984",
    CONF,
    MISC
);

pub(
    "D.P. Anderson and G. Homsy, Synchronization Policies and Mechanisms in a Continuous Media I/O Server, Technical Report No. 91/617, CS Div., EECS Dept., UC Berkeley",
    "February 1991",
    TR,
    CM
);

pub(
    "David P. Anderson.  Meta-Scheduling for Distributed Continuous Media. Technical Report, EECS Dept, UC Berkeley",
    "Oct. 4, 1990",
    TR,
    CM,
    "https://www2.eecs.berkeley.edu/Pubs/TechRpts/1990/CSD-90-599.pdf"
);

pub(
    "G. Homsy, R. Govindan and D.P. Anderson, Implementation Issues for a Network Audio/Video Server, Technical Report No. 90/597, CS Div., EECS Dept., UC Berkeley",
    "September 1990",
    TR,
    CM
);

pub(
    "D.P. Anderson, R. Govindan, G. Homsy and R. Wahbe, Integrated Continuous Media: A Framework Based on Mach, X11, and TCP/IP, Technical Report No. 90/566, CS Div., EECS Dept., UC Berkeley",
    "March 1990",
    TR,
    CM
);

pub(
    "D.P. Anderson, R.G. Herrtwich and C. Schaefer, SRP: A Resource Reservation Protocol for Guaranteed-Performance Communication in the Internet, Technical Report No. 90/562, CS Div., EECS Dept., UC Berkeley",
    "February 1990",
    TR,
    CM
);

pub(
    "D.P. Anderson and R. Wahbe, The DASH Network Communication Architecture, Technical Report No. 88/462, CS Div., EECS Dept., UC Berkeley",
    "November 1988",
    TR,
    DASH,
    "https://apps.dtic.mil/sti/pdfs/ADA620736.pdf"
);

pub(
    "S. Tzou and D.P. Anderson, A Performance Evaluation of the DASH Message-Passing System, Technical Report No. 88/452, CS Div., EECS Dept., UC Berkeley",
    "November 1988",
    TR,
    DASH,
    "https://apps.dtic.mil/sti/pdfs/ADA619795.pdf"
);

pub(
    "D.P. Anderson and S. Tzou, The DASH Local Kernel Structure, Technical Report No. 88/463, CS Div., EECS Dept., UC Berkeley",
    "November 1988",
    TR,
    DASH,
    "https://www2.eecs.berkeley.edu/Pubs/TechRpts/1988/CSD-88-463.pdf"
);

pub(
    "D.P. Anderson, S. Tzou and G.S. Graham, The DASH Virtual Memory System, Technical Report No. 88/461, CS Div., EECS Dept., UC Berkeley",
    "November 1988",
    TR,
    DASH,
    "https://apps.dtic.mil/sti/pdfs/ADA620735.pdf"
);

pub(
    "S. Tzou, D.P. Anderson and G.S. Graham, Efficient Local Data Movement in Shared-Memory Multiprocessor Systems, Technical Report No. 87/385, CS Div., EECS Dept., UC Berkeley",
    "December 1987",
    TR,
    DASH,
    "https://apps.dtic.mil/sti/pdfs/ADA604009.pdf"
);

pub(
    "D.P. Anderson, D. Ferrari and P.V. Rangan, Subtransport Level: The Right Place for End-to-End Security Mechanisms, Technical Report No. 87/346, CS Div., EECS Dept., UC Berkeley",
    "March 1987",
    TR,
    DASH,
    "https://apps.dtic.mil/sti/pdfs/ADA619419.pdf"
);

pub(
    "D.P. Anderson and D. Ferrari, The DASH Project: An Overview, Technical Report No.  88/405, CS Div., EECS Dept., UC Berkeley",
    "February 1988",
    TR,
    DASH,
    "https://apps.dtic.mil/sti/pdfs/ADA611540.pdf"
);

pub(
    "D.P. Anderson, D. Ferrari, P.V. Rangan and S. Tzou, The DASH Project: Issues in the Design of Very Large Distributed Systems, Technical Report No. 87/338, CS Div., EECS Dept., UC Berkeley",
    "January 1987",
    TR,
    DASH
);

pub(
    "D.P. Anderson and J. Kubiatowicz.  The World-Wide Computer.  Scientific American 286(3), pp. 40-47",
    "March 2002",
    MAG,
    BOINC,
    "http://www.scrkkio.pwr.wroc.pl/~juszczyszyn/ISOS.pdf"
);

pub(
    "D.P. Anderson.  SETI@home.  A chapter in Peer-to-Peer: Harnessing the power of disruptive technologies, edited by Andy Oram, O'Reilly and Assoc",
    "2001",
    BOOK,
    BOINC
);

pub(
    "David P Anderson, Ralf Guido Herrtwich.  Internet communication with end-to-end performance guarantees.  Telekommunikation und multimediale Anwendungen der Informatik.  pp. 246-258",
    "1991",
    BOOK,
    CM
);

pub(
    "David P. Anderson, James A. Moorer. Method of dynamically allocating network node memory's partitions for caching distributed files. U.S. Patent no. 6047356",
    "April 4, 2000",
    PATENT,
    CM,
    "https://patentimages.storage.googleapis.com/6d/43/b5/f6afe0cfea027e/US6047356.pdf"
);

pub(
    "Edward A Hubbard, Krishnamurthy Venkatramani, David P Anderson, Ashok K Adiga, Greg D Hewgill, Jeff A Lawson.  Dynamic coordination and control of network connected devices for large-scale network site testing and associated architectures.  U.S. Patent no. 7254607",
    "Aug. 7, 2007",
    PATENT,
    BOINC,
    "https://patentimages.storage.googleapis.com/a7/a6/67/0bd8606d96ef25/US7254607.pdf"
);

pub(
    "Edward Hubbard, Sriram Mandyam, Krishnamurthy Venkatramani, Ashok Adiga, David Anderson, Greg Hewgill, Jeff Lawson.  Massively distributed processing system architecture, scheduling, unique device identification and associated methods. U.S. Patent no. 10402331",
    "July 29, 2007",
    PATENT,
    BOINC
);

pub(
    "Edward A Hubbard, Krishnamurthy Venkatramani, Sriram S Mandyam, David P Anderson.  Massively distributed processing system with modular client agent and associated method.  U.S. Patent no. 7039670",
    "May 2, 2006",
    PATENT,
    BOINC,
    "https://patentimages.storage.googleapis.com/3f/5a/2c/d2e443081c8818/US7039670.pdf"
);

pub(
    "David Anderson, Edward Hubbard.  Massively distributed database system and associated method.  U.S. Patent Application no. 09872251",
    "Oct. 4, 2001",
    PATENT,
    BOINC,
    "https://patentimages.storage.googleapis.com/56/72/dd/6a58e8fa906fd2/US20010027467A1.pdf"
);

pub(
    "David P. Anderson.  Virtual Reality Television System.  U.S. Patent no. 5714997",
    "1998",
    PATENT,
    CM,
    "https://patentimages.storage.googleapis.com/88/19/4d/696d23f0c375b6/US5714997.pdf"
);


function compare($p1, $p2) {
    return $p1->time < $p2->time;
}

usort($pubs, 'compare');
?>
