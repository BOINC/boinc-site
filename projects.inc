<?php

// To add a project:
//
// - make a new ID in project_ids.inc
// - make new keywords if needed in boinc/html/inc/keywords.inc
// - get logo image if there is one
// - add project here
// - post news item if desired
//
// If you add or change anything:
// - look at https://boinc.berkeley.edu/project_list.php
//      in a browser to make sure you didn't mess up the XML
// - update Science United: su/project_init.php
// - wget https://boinc.berkeley.edu/project_list.php and move to
//      boinc/win_build/installerv2/redist/all_projects_list.xml
//      (deprecated - this is automated via a Github action)
//
// Use tra() where relevant, and update the BOINC Web site .pot file
// (boinc-site/build_po.php)

require_once("../inc/util.inc");
//require_once("../inc/translation.inc");
require_once("../inc/keywords.inc");
require_once("../inc/project_ids.inc");

function project(
    $id, $name, $web_url, $home, $area, $description,
    $logo, $master_url, $summary, $keywords
) {
    $x = new StdClass;
    $x->id = $id;
    $x->name = $name;
    $x->web_url = $web_url;
    $x->home = $home;
    $x->area = $area;
    $x->description = $description;
    $x->logo = $logo;
    $x->master_url = $master_url?$master_url:$web_url;
    $x->summary = $summary;
    $x->keywords = $keywords;
    return $x;
}

// 0: ID (from project_ids.inc)
// 1: name
// 2: web RPC URL
// 3: home
// 4: area
// 5: description
// 6: logo
// 7: master URL (if different from web RPC URL)
//      This should match their get_project_config.php
//      maybe should automate this
// 8: 1-sentence summary

$sensing = array(
    tra("Distributed sensing"),
    array(
//        project(
//            PROJ_QCN,
//            "Quake Catcher Network",
//            "http://quakecatcher.net/sensor",
//            tra("University of Southern California"),
//            tra("Seismology"),
//            tra("Quake-Catcher Network uses sensors attached to computers and smartphones to detect seismic waves."),
//            "",
//            "http://quakecatcher.net/sensor/",
//            "Help detect earthquakes",
//            array(KW_EARTH_SCI, KW_AMERICAS, KW_US, KW_USC)
//        ),
        project(
            PROJ_RADIOACTIVE,
            "Radioactive@Home",
            "http://radioactiveathome.org/boinc/",
            tra("BOINC Poland Foundation"),
            tra("Environmental research"),
            tra("Radioactive@Home is creating a free and continuously updated map of radiation levels using sensors connected to volunteers' computers.  You must buy a sensor to participate."),
            "radioactive.jpg",
            "",
            tra("Monitor radiation levels"),
            array(KW_ENV_RESEARCH, KW_EUROPE, KW_POLAND)
        ),
    ),
);

$cogsci = array(
    tra("Cognitive science and artificial intelligence"),
    array(
//        project(
//            PROJ_MINDMODELING,
//            "MindModeling@Home",
//            "https://mindmodeling.org/",
//            "University of Dayton and Wright State University",
//            tra("Cognitive Science"),
//            tra("MindModeling@Home uses computational cognitive process modeling to better understand the human mind, and specifically to study the mechanisms and processes that enable and moderate human performance and learning."),
//            "mmlogo.gif",
//            "",
//            "Model the human brain",
//            array(KW_AI, KW_AMERICAS, KW_US, KW_U_DAYTON)
//        ),
//        project(
//            PROJ_MLC,
//            "MLC@Home",
//            "https://www.mlcathome.org/mlcathome/",
//            "University of Maryland, Baltimore County (UMBC)",
//            tra("Artificial Intelligence"),
//            tra("MLC@Home is dedicated to understanding and interpreting complex machine learning models, with an emphasis on neural networks."),
//            "mlcathome-banner.png",
//            "",
//            "Study machine learning",
//            array(KW_AI, KW_AMERICAS, KW_US)
//        ),
//        project(
//            0,
//            "FreeHAL",
//            "http://www.freehal.net/freehal_at_home/",
//            tra("Independent"),
//            tra("Artificial intelligence"),
//            tra("Parse and convert semantic nets for use in FreeHAL, an artificial intelligence that uses semantic networks, stemmers, part of speech databases, and part of speech taggers in order to imitate human behavior in conversations."),
//            "",
//            "",
//            "Create an artificial intelligence",
//            array()
//        ),
    ),
);

$biomed = array(
    tra("Biology and Medicine"),
    array(
        project(
            PROJ_SIDOCK,
            "SIDock@home",
            "https://www.sidock.si/sidock/",
            "The COVID.SI project and the Karelian Research Center of the Russian Academy of Sciences",
            tra("Biomedicine"),
            tra("Study drugs to fight SARS-CoV-2"),
            "sidock.png",
            "",
            tra("Study drugs to fight SARS-CoV-2"),
            array(KW_BIOMED, KW_DISEASE, KW_VIRUS, KW_EUROPE, KW_RUSSIA)
        ),
//        project(
//            PROJ_IBERCIVIS,
//            "Ibercivis BOINC",
//            "https://boinc.ibercivis.es/ibercivis/",
//            "Consejo Superior de Investigaciones Cientifica",
//            tra("Biomedicine"),
//            tra("Simulate the interaction of drugs used against Ebola, HIV, influenza or hepatitis B with the replication machinery of the SARS-CoV-2 virus. This will show if any of the molecules inhibits a key protein in the multiplication of the virus called 'RNA-dependent RNA polymerase'. If so, the drug would become an ideal candidate for testing in human clinical trials."),
//            "ibercivis.png",
//            "",
//            tra("Help the fight against SARS-CoV-2"),
//            array(KW_BIOMED, KW_DISEASE, KW_VIRUS, KW_EUROPE, KW_SPAIN)
//        ),
        project(
            PROJ_DENIS,
            "DENIS@Home",
            "https://denis.usj.es/denisathome/",
            "San Jorge University, Zaragoza, Spain",
            tra("Medical physiology"),
            tra("DENIS@Home does cardiac electrophysiological simulations, studying the electrical activity of the heart."),
            "",
            "https://denis.usj.es/denisathome/",
            tra("Study the physiology of the heart"),
            array(KW_BIOMED, KW_EUROPE, KW_SPAIN)
        ),
        project(
            PROJ_RNA_WORLD,
            "RNA World",
            "https://www.rnaworld.de/rnaworld/",
            "Rechenkraft.net e.V.",
            tra("Molecular biology"),
            tra("RNA World seeks to identify, analyze, structurally predict and design RNA molecules on the basis of established bioinformatics software."),
            "rna4.png",
            "",
            tra("Study and design RNA molecules"),
            array(KW_BIOMED, KW_GENETICS, KW_EUROPE, KW_GERMANY)
        ),
        project(
            PROJ_GPU_GRID,
            "GPUGrid.net",
            "https://www.gpugrid.net/",
            "Barcelona Biomedical Research Park (PRBB)",
            tra("Molecular simulations of proteins"),
            tra("GPUGrid.net opens novel computational scenarios by the first full-atom molecular dynamics code (CellMD) specially optimized to run on NVIDIA GPUs. New biomedical applications suddenly become possible giving a new role to computational biology for biomedical research."),
            "gpugrid.png",
            "https://www.gpugrid.net/",
            tra("Help biomedical research"),
            array(KW_BIOMED, KW_DISEASE, KW_CANCER, KW_VIRUS, KW_EUROPE, KW_SPAIN, KW_PRBB)
        ),
        project(
            PROJ_ROSETTA,
            "Rosetta@home",
            "https://boinc.bakerlab.org/rosetta/",
            "University of Washington",
            tra("Biology"),
            tra("Determine the 3-dimensional shapes of proteins in research that may ultimately lead to finding cures for some major human diseases. By running Rosetta@home you will help us speed up and extend our research in ways we couldn't possibly attempt without your help. You will also be helping our efforts at designing new proteins to fight diseases such as COVID-19, HIV, malaria, cancer, and Alzheimer's"),
            "rosetta_at_home_logo.jpg",
            "",
            tra("Study diseases such as COVID-19, HIV, malaria, cancer, and Alzheimer's"),
            array(KW_BIOMED, KW_DISEASE, KW_PROTEINS, KW_AMERICAS, KW_US, KW_UW, KW_VIRUS)
        ),
    ),
);
$earth = array(
    tra("Earth Sciences"),
    array(
        project(
            PROJ_CPDN,
            "Climateprediction.net",
            "https://climateprediction.net/",
            "Oxford University",
            tra("Climate study"),
            tra("Investigate the approximations that have to be made in state-of-the-art climate models. By running the model thousands of times we hope to find out how the model responds to slight tweaks to these approximations - slight enough to not make the approximations any less realistic. This will allow us to improve our understanding of how sensitive our models are to small changes and also to things like changes in carbon dioxide and the sulphur cycle. This will allow us to explore how climate may change in the next century under a wide range of different scenarios."),
            "cpn_logo_world_1.jpg",
            "https://climateprediction.net/",
            tra("Study long-term climate change"),
            array(KW_EARTH_SCI, KW_CLIMATE, KW_EUROPE, KW_UK, KW_OXFORD)
        ),
    ),
);
$astro_phys_chem = array(
    tra("Physical Science"),
    array(
//        project(
//            PROJ_QUCHEM,
//            "QuChemPedIA@home",
//            "https://quchempedia.univ-angers.fr/athome/",
//            "Université d’Angers",
//            "Molecular Chemistry",
//            "This project will create an open platform to solve and store quantum molecular chemistry results, and will develop artificial intelligence and optimization methods in order to efficiently explore the highly combinatorial molecular space.",
//            "",
//            "",
//            "Explore molecular chemistry",
//            array(KW_CHEMISTRY, KW_EUROPE, KW_FRANCE)
//        ),
//        project(
//            PROJ_ACOUSTICS,
//            "Acoustics@home",
//            "http://www.acousticsathome.ru/boinc/",
//            "V.I. Ilichev Pacific Oceanological Institute, Far Eastern Federal University, Matrosov Institute for System Dynamics and Control Theory, A.A. Kharkevich Institute for Information Transmission Problems, Dorodnicyn Computing Centre",
//            "Physics, Underwater acoustics",
//            "In underwater acoustics the notion of geoacoustic inversion refers to a collection of techniques that can be used for the reconstruction of medium parameters. The medium parameters are usually understood as the sound speed profile in water (i.e., the dependence of the sound speed on the depth) and the sound speed and density in the sea bottom sediment layers. Medium parameters reconstruction is of great importance for problems of underwater communication and for the development of underwater navigation systems.",
//            "",
//            "",
//            "Study underwater acoustics",
//            array(KW_PHYSICS, KW_EUROPE, KW_RUSSIA)
//        ),
//        project(
//            PROJ_POGS,
//            "theSkyNet POGS",
//            "http://pogs.theskynet.org/pogs/",
//            "The International Centre for Radio Astronomy Research (Perth, Australia)",
//            tra("Astronomy"),
//            tra("TheSkyNet POGS is an astronomy project studying 16 different properties of galaxies, including brightness, mass, amount of dust and how fast stars are forming. We are using your processing power to conduct pixel-by-pixel calculations on multi-wavelength (ultraviolet, optical and near-infrared light) images of galaxies to produce an atlas that will help astronomers to better understand the distant universe."),
//
//            "",
//            "",
//            "Analyze images of space",
//            array(KW_ASTRONOMY, KW_OCEANIA, KW_AUSTRALIA)
//        ),
//        project(
//            PROJ_SOURCEFINDER,
//            "SourceFinder",
//            "https://sourcefinder.theskynet.org/duchamp/",
//            "The International Centre for Radio Astronomy Research (Perth, Australia)",
//            tra("Astronomy"),
//            "Sourcefinder aims to test the effectiveness of algorithms that process 'cubes' of data that contain radio sources, and identify the location of the sources within the cube.",
//            "",
//            "",
//            "Improve radio astronomy algorithms",
//            array(KW_ASTRONOMY, KW_OCEANIA, KW_AUSTRALIA)
//        ),
        project(
            PROJ_ASTEROIDS,
            "Asteroids@home",
            "http://asteroidsathome.net/boinc/",
            "Charles University in Prague",
            tra("Astrophysics"),
            tra("The aim of the project is to derive shapes and spin for a significant part of the asteroid population. As input data, we use any asteroid photometry that is available. The results are asteroid convex shape models with the direction of the spin axis and the rotation period."),
            "asteroids_logo.jpg",
            "",
            tra("Study the properties of asteroids"),
            array(KW_ASTRONOMY, KW_EUROPE, KW_CZECH, KW_CHARLES_PRAGUE)
        ),
//        project(
//            PROJ_COSMOLOGY,
//            "Cosmology@Home",
//            "http://www.cosmologyathome.org/",
//            tra("University of Illinois at Urbana-Champaign"),
//            tra("Astronomy"),
//            tra("The goal of Cosmology@Home is to search for the model that best describes our Universe and to find the range of models that agree with the available astronomical particle physics data."),
//            "cosmo.jpg",
//            "",
//            "Study the evolution of the Universe",
//            array(KW_ASTRONOMY, KW_COSMOLOGY, KW_AMERICAS, KW_US, KW_U_ILLINOIS)
//        ),
//        project(
//            PROJ_UNIVERSE,
//            "Universe@Home",
//            "https://universeathome.pl/universe/",
//            "University of Warsaw",
//            tra("Astronomy"),
//            tra("Universe@Home aims to create the first database of the simulated stellar content of the Universe, from the earliest stars to the most exotic black hole binaries."),
//            "universe_at_home.png",
//            "",
//            tra("Do research in physics and astronomy"),
//            array(KW_ASTRONOMY, KW_EUROPE, KW_POLAND, KW_U_WARSAW)
//        ),
        project(
            PROJ_MILKYWAY,
            "Milkyway@home",
            "https://milkyway.cs.rpi.edu/milkyway/",
            "Rensselaer Polytechnic Institute",
            tra("Astronomy"),
            tra("The goal of Milkyway@Home is to create a highly accurate three dimensional model of the Milky Way galaxy using data gathered by the Sloan Digital Sky Survey."),
            "mw.png",
            "",
            tra("Study the structure of the Milky Way galaxy"),
            array(KW_ASTRONOMY, KW_AMERICAS, KW_US, KW_RPI)
        ),
//        project(
//            PROJ_LEIDEN,
//            "Leiden Classical",
//            "http://boinc.gorlaeus.net/",
//            tra("Leiden University, The Netherlands"),
//            tra("Chemistry"),
//            tra("Surface science calculations using Classical Dynamics.  Leiden Classical allows volunteers, students and other scientist to submit their personal calculations to the grid. Each user has his own personal queue for Classical Dynamics jobs. In this way students have used the grid to simulate liquid argon, or to test the validity of the ideal gas law by actually doing the simulations through the grid."),
//            "leiden_classical.png",
//            "",
//            tra("Help students do atomic simulations"),
//            array(KW_CHEMISTRY, KW_EUROPE, KW_HOLLAND)
//        ),
        project(
            PROJ_EINSTEIN,
            "Einstein@home",
            "https://einsteinathome.org/",
            "University of Wisconsin - Milwaukee (USA), Max Planck Institute for Gravitational Physics - Hanover (Germany)",
            tra("Astrophysics"),
            tra("Einstein@Home uses your computer's idle time to search for weak astrophysical signals from spinning neutron stars (often called pulsars) using data from the LIGO gravitational-wave detectors, the Arecibo radio telescope, and the Fermi gamma-ray satellite."),
            "einstein.jpg",
            "https://einstein.phys.uwm.edu/",
            tra("Help detect pulsars and gravitational waves"),
            array(KW_ASTRONOMY, KW_GW, KW_PULSARS, KW_INTERNATIONAL, KW_AEI)
        ),
        project(
            PROJ_LHC,
            "LHC@home",
            "https://lhcathome.cern.ch/lhcathome/",
            tra("CERN (European Organization for Nuclear Research)"),
            tra("Physics"),
            tra("The Large Hadron Collider (LHC) is a particle accelerator at CERN, the European Organization for Nuclear Research, the world's largest particle physics laboratory.  It is the most powerful instrument ever built to investigate on particles proprieties. LHC@home runs simulations to improve the design of LHC and its detectors."),
            "lhc.jpg",
            "",
            tra("Improve the design of the Large Hadron Collider"),
            array(KW_PHYSICS, KW_PARTICLE_PHYSICS, KW_INTERNATIONAL, KW_CERN)
        ),
//        project(
//            PROJ_SETI,
//            "SETI@home",
//            "http://setiathome.berkeley.edu/",
//            tra("University of California, Berkeley"),
//            tra("Astrophysics, astrobiology"),
//            tra("SETI (Search for Extraterrestrial Intelligence) is a scientific area whose goal is to detect intelligent life outside Earth. One approach, known as radio SETI, uses radio telescopes to listen for narrow-bandwidth radio signals from space. Such signals are not known to occur naturally, so a detection would provide evidence of extraterrestrial technology."),
//            "seti_logo.png",
//            "",
//            tra("Search for evidence of extra-terrestrial life"),
//            array(KW_ASTRONOMY, KW_SETI, KW_AMERICAS, KW_US, KW_UCB)
//        ),
//        project(
//            PROJ_NANOHUB,
//            "nanoHUB@Home",
//            "https://boinc.nanohub.org/nanoHUB_at_home/",
//            "Purdue University",
//            "Nanoscience",
//            "nanoHUB@Home provides computing power to users of the nanoHUB portal for nanoscience.",
//            "",
//            "",
//            "",
//            array(KW_AMERICAS, KW_US, KW_NANOSCIENCE)
//        ),
    ),
);

$mixed = array(
    tra("Multiple applications"),
    array(
//        project(
//            PROJ_CSG,
//            "Citizen Science Grid",
//            "https://csgrid.org/csg/",
//            "University of North Dakota",
//            tra("Molecular biology, Computer Science"),
//            tra("The Citizen Science Grid is dedicated to supporting a wide range of research and educational projects using volunteer computing and citizen science."),
//            "",
//            "",
//            tra("Support science from the University of North Dakota"),
//            array(KW_BIOMED, KW_MATH_CS, KW_AMERICAS, KW_US, KW_UND)
//        ),
//        project(
//            PROJ_CAS,
//            "CAS@home",
//            "http://casathome.ihep.ac.cn/",
//            tra("Chinese Academy of Sciences"),
//            tra("Physics, biochemistry, and others"),
//            tra("CAS@home is hosted by the Computing Centre of the Institute of High Energy Physics (IHEP), Chinese Academy of Sciences, for Chinese scientists with projects studying protein structure, nanotechnology, cancer genomics, and high energy physics."),
//            "cas_at_home.jpg",
//            "",
//            tra("Help Chinese researchers"),
//            array(KW_PHYSICS, KW_BIOMED, KW_ASIA, KW_CHINA)
//        ),
        project(
            PROJ_YOYO,
            "Yoyo@home",
            "https://www.rechenkraft.net/yoyo/",
            tra("Independent"),
            tra("Mathematics"),
            tra("Yoyo@home is an adapter between BOINC and several existing volunteer computing projects."),
            "",
            "",
            tra("Do research in math"),
            array(KW_MATH_CS, KW_EUROPE, KW_GERMANY)
        ),
        project(
            PROJ_WCG,
            "World Community Grid",
            "https://www.worldcommunitygrid.org/",
            "Krembil Research Institute",
            tra("Medical, environmental and other humanitarian research"),
            tra("To further critical non-profit research on some of humanity's most pressing problems by creating the world's largest volunteer computing grid.  Research includes HIV-AIDS, cancer, tropical and neglected diseases, solar energy, clean water and many more."),
            "wcg.jpg",
            "",
            tra("Do biomedical and environmental research"),
            array(KW_BIOMED, KW_DRUG_DISCOVERY, KW_CANCER, KW_VIRUS, KW_EARTH_SCI, KW_AMERICAS, KW_US)
        ),
//        project(
//            PROJ_TACC,
//            "BOINC@TACC",
//            "https://boinc.tacc.utexas.edu/",
//            "Texas Advanced Computing Center",
//            "Multiple scientific areas",
//            "BOINC@TACC provides computing power to U.S. researchers in multiple scientific areas.",
//            "",
//            "https://boinc.tacc.utexas.edu/",
//            "",
//            array(KW_AMERICAS, KW_US)
//        ),
        project(
            PROJ_CENTRAL,
            "BOINC Central",
            "https://boinc.berkeley.edu/central/",
            "University of California, Berkeley",
            tra("Multiple science areas"),
            tra("BOINC Central provides computing power to scientists from multiple institutions"),
            "",
            "",
            tra("Support scientists from multiple institutions"),
            array(KW_AMERICAS, KW_US, KW_BIOMED)
        ),
    ),
);
$math = array(
    tra("Mathematics, computing, and games"),
    array(
        project(
            PROJ_ITHENA,
            "iThena",
            "https://root.ithena.net/usr/",
            "Cyber-Complex Foundation",
            tra("Computer science"),
            tra("The goal of the iThena project is to generate a dynamic topological model of the Internet, based on measurements from distributed devices."),
            "",
            "",
            tra("Study the Internet"),
            array(KW_MATH_CS)
        ),
        project(
            PROJ_AMICABLE,
            "Amicable Numbers",
            "https://sech.me/boinc/Amicable/",
            tra("Independent"),
            tra("Mathematics"),
            tra("'Amicable numbers' are pairs where the sum of the proper divisors of each is equal to the other number. The goal of this project is to collect all amicable numbers up to a very large limit."),
            "",
            "",
            tra("Do research in number theory"),
            array(KW_MATH_CS, KW_NUMBER_THEORY, KW_EUROPE)
        ),
        project(
            PROJ_NUMBERFIELDS,
            "NumberFields@home",
            "https://numberfields.asu.edu/NumberFields/",
            "Arizona State University, school of Mathematics",
            tra("Mathematics"),
            tra("NumberFields@home searches for fields with special properties. The primary application of this research is in the realm of algebraic number theory. Number theorists can mine the data for interesting patterns to help them formulate conjectures about number fields. Ultimately, this research will lead to a deeper understanding of the profound properties of numbers, the basic building blocks of all mathematics."),
            "nf_banner_10.jpg",
            "https://numberfields.asu.edu/NumberFields/",
            tra("Do research in algebraic number theory"),
            array(KW_MATH_CS, KW_AMERICAS, KW_US, KW_ARIZONA_STATE)
        ),
        project(
            PROJ_ODLK,
            "ODLK",
            "https://boinc.progger.info/odlk/",
            tra("Independent"),
            tra("Mathematics"),
            tra("OLDK is building a database of canonical forms of diagonal Latin squares of the 10th order"),
            "",
            "",
            tra("Discover Latin Squares"),
            array(KW_MATH_CS, KW_EUROPE, KW_RUSSIA, KW_RAS)
        ),
        project(
            PROJ_ODLK1,
            "ODLK1",
            "https://boinc.multi-pool.info/latinsquares/",
            tra("Independent"),
            tra("Mathematics"),
            "OLDK is building a database of canonical forms of diagonal Latin squares of the 10th order",
            "",
            "",
            tra("Discover Latin Squares"),
            array(KW_MATH_CS, KW_EUROPE, KW_RUSSIA, KW_RAS)
        ),
//        project(
//            PROJ_SAT,
//            "SAT@home",
//            "http://sat.isa.ru/pdsat/",
//            "Institute for System Dynamics and Control Theory and Institute for Information Transmission Problems, Russian Academy of Science",
//            tra("Computer Science"),
//            tra("Solve hard and practically important problems (discrete functions inversion problems, discrete optimization, bioinformatics, etc.) that can be effectively reduced to Boolean satisfiability problem."),
//            "sat_logo.png",
//            "",
//            tra("Study computational complexity"),
//            array(KW_MATH_CS, KW_EUROPE, KW_RUSSIA, KW_RAS)
//        ),
        project(
            PROJ_MOO,
            "Moo! Wrapper",
            "https://moowrap.net/",
            tra("Independent"),
            tra("Cryptography and combinatorics"),
            tra("Run applications from distributed.net"),
            "",
            "",
            tra("Run applications from distributed.net"),
            array(KW_MATH_CS)
        ),
//        project(
//            PROJ_ENIGMA,
//            "Enigma@Home",
//            "http://www.enigmaathome.net/",
//            tra("Independent"),
//            tra("Cryptography"),
//            tra("Attempt to decode 3 original Enigma messages. The signals were intercepted in the North Atlantic in 1942 and are believed to be unbroken."),
//            "",
//            "",
//            tra("Decode WWII submarine messages"),
//            array(KW_MATH_CS, KW_EUROPE)
//        ),
//        project(
//            PROJ_COLLATZ,
//            "Collatz Conjecture",
//            "https://boinc.thesonntags.com/collatz/",
//            tra("Independent"),
//            tra("Mathematics"),
//            tra("Study the Collatz Conjecture, an unsolved conjecture in mathematics"),
//            "",
//            "",
//            tra("Study the Collatz Conjecture"),
//            array(KW_MATH_CS, KW_NUMBER_THEORY, KW_EUROPE)
//        ),
        project(
            PROJ_NFS,
            "NFS@home",
            "https://escatter11.fullerton.edu/nfs/",
            "California State University Fullerton",
            tra("Factorization of large integers"),
            tra("NFS@Home is a research project that uses Internet-connected computers to do the lattice sieving step in the Number Field Sieve factorization of large integers. As a young school student, you gained your first experience at breaking an integer into prime factors, such as 15 = 3 * 5 or 35 = 5 * 7. NFS@Home is a continuation of that experience, only with integers that are hundreds of digits long."),
            "NFS_Logo.jpg",
            "",
            tra("Study the factorization of large integers"),
            array(KW_MATH_CS, KW_NUMBER_THEORY, KW_AMERICAS, KW_US, KW_FULLERTON)
        ),
        project(
            PROJ_PRIMEGRID,
            "PrimeGrid",
            "https://www.primegrid.com/",
            tra("Independent"),
            tra("Mathematics"),
            tra("Primegrid has multiple projects searching for different forms of very large prime numbers, including searching for the largest known prime number."),
            "primegrid_logo.png",
            "",
            tra("Search for large prime numbers"),
            array(KW_MATH_CS, KW_NUMBER_THEORY, KW_EUROPE)
        ),
//        project(
//            PROJ_PRIMABOINCA,
//            "primaboinca",
//            "http://www.primaboinca.com/",
//            tra("Hochschule RheinMain University of Applied Sciences"),
//            tra("Mathematics"),
//            tra("Search for counterexamples to two conjectures related to the identification of prime numbers"),
//            "logo_primaboinca.gif",
//            "",
//            tra("Study the properties of prime numbers"),
//            array(KW_MATH_CS, KW_NUMBER_THEORY, KW_EUROPE, KW_GERMANY)
//        ),
//        project(
//            PROJ_SZTAKI,
//            "SZTAKI Desktop Grid",
//            "http://szdg.lpds.sztaki.hu/szdg/",
//            tra("MTA-SZTAKI Laboratory of Parallel and Distributed Systems (Hungary)"),
//            tra("Mathematics"),
//            tra("Find all the generalized binary number systems (in which bases are matrices and digits are vectors) up to dimension 11."),
//            "szdg1_small.jpg",
//            "",
//            tra("Study number theory"),
//            array(KW_MATH_CS, KW_EUROPE, KW_HUNGARY)
//        ),
        project(
            PROJ_GERASIM,
            "Gerasim@Home",
            "https://gerasim.boinc.ru/",
            "Southwest State University (Russia)",
            tra("Computer engineering"),
            tra("Testing and comparison of heuristic methods for getting separations of parallel algorithms working in the CAD system for designing logic control systems"),
            "gerasim.gif",
            "",
            "",
            array(KW_MATH_CS, KW_EUROPE, KW_RUSSIA)
        ),
        project(
            PROJ_SRBASE,
            "SRBase",
            "https://srbase.my-firewall.org/sr5/",
            tra("Independent"),
            tra("Mathematics"),
            tra("SRBase is a mathematical research project that uses Internet-connected computers trying to solve Sierpinski / Riesel Bases up to 1030."),
            "",
            "",
            "",
            array(KW_MATH_CS, KW_NUMBER_THEORY)
        ),
//        project(
//            PROJ_DHEP,
//            "Distributed Hardware Evolution Project",
//            "https://dhep.ga/boinc/",
//            "University of Sussex",
//            "Electrical Engineering",
//            "DHEP uses a Genetic Algorithm in a coevolutionary setting to synthesise future super-reliable electronics such as those used in autonomous vehicles, power stations, medical equipment, aerospace. These are of increasingly paramount importance as more and more human lives rely on well functioning hardware.",
//            "dhep.png",
//            "",
//            "Help design super-reliable electronic circuits",
//            array(KW_MATH_CS, KW_EUROPE, KW_UK)
//        ),
//        project(
//            PROJ_DBN,
//            "DBN Upper Bound",
//            "http://anthgrid.com/dbnupperbound/",
//            "Independent",
//            "Mathematics",
//            "DBN Upper Bound does computations related to the Riemann zeta function.",
//            "",
//            "",
//            "",
//            array(KW_MATH_CS)
//        ),
        project(
            PROJ_RAKESEARCH,
            'RakeSearch',
            'https://rake.boincfast.ru/rakesearch/',
            'Karelian Research Center, Russian Academy of Sciences',
            tra('Mathematics'),
            tra('The enormous size of the diagonal Latin squares space makes it unfeasible to enumerate all its objects straightforwardly in reasonable time. So, in order to discover the structure of this space, sophisticated search methods are needed. In RakeSearch project, we implement an application that picks up separate pairs of mutually orthogonal DLSs, which allows to reconstruct full graphs of their orthogonality.'),
            '',
            '',
            tra('Study Latin Squares'),
            array(KW_MATH_CS, KW_EUROPE, KW_RUSSIA)
        ),
//        project(
//            PROJ_MINECRAFT,
//            'Minecraft@Home',
//            'https://minecraftathome.com/minecrafthome/',
//            'Independent',
//            'Games',
//            'Minecraft@Home studies questions related to Minecraft, such as the properties of worlds that can be generated from different random seeds.',
//            'minecraft_at_home.png width=400',
//            '',
//            'Explore Minecraft',
//            array(KW_MATH_CS, KW_GAMES)
//        ),
        project(
            PROJ_RAMANUJAN,
            'Ramanujan Machine',
            'https://www.ramanujanmachine.com/',
            tra('Independent'),
            tra('Mathematics'),
            tra('The Ramanujan Machine uses your computer power to search for new mathematical formulas.'),
            '',
            'https://rnma.xyz/boinc/',
            tra('Discover new mathematical formulas'),
            array(KW_MATH_CS)
        ),
        project(
            PROJ_LODA,
            'LODA',
            'https://boinc.loda-lang.org/loda/',
            tra('Independent'),
            tra('Mathematics'),
            tra('The goal of LODA is to find new formulas and more efficient algorithms for a range of integer sequences.'),
            '',
            '',
            tra('Mine mathematical programs'),
            array(KW_MATH_CS)
        ),
        project(
            PROJ_YAFU,
            'YAFU',
            'https://yafu.myfirewall.org/yafu/',
            tra("Independent"),
            tra("Mathematics"),
            tra("YAFU's goal is to factor numbers of up to 149 digits which are needed to bring Aliquot Sequences to a size of at least 140."),
            "",
            "",
            tra("Do research in math"),
            array(KW_MATH_CS, KW_EUROPE, KW_GERMANY)
        ),
    ),
);

$areas = array(
    $biomed, $astro_phys_chem, $math, $earth, $mixed, $cogsci, $sensing
);

function lookup_project($url) {
    foreach ($areas as $area) {
        foreach ($area as $p) {
            if ($p[1] == $url) return $p;
            if (sizeof($p)>6 && $p[6] == $url) return $p;
        }
    }
    return null;
}

function get_project_list($test = false) {
    global $areas;
    foreach ($areas as $area) {
        $area_name = $area[0];
        $projects = $area[1];
        foreach ($projects as $p) {
            if (!$test && $p->id >= 1000) continue;
                // test projects have temp IDs >= 1000
            $p->general_area = $area_name;
            $proj_list[] = $p;
        }
    }
    return $proj_list;
}

function acct_mgr($id, $name, $url, $description, $logo) {
    $x = new StdClass;
    $x->id = $id;
    $x->name = $name;
    $x->url = $url;
    $x->description = $description;
    $x->logo = $logo;
    return $x;
}

$account_managers = array(
    acct_mgr(
        PROJ_BAM,
        "BAM!",
        "https://bam.boincstats.com/",
        tra("BAM! lets you create and manage BOINC project accounts, set preferences, join or create teams, connect your computers to projects, and much more."),
        "BAM.png"
    ),
// GR lists non-existent projects like Predictor@home, Spinhenge, SZTAKI etc.
// and non-projects like Alpha test
//    acct_mgr(
//        PROJ_GRIDREPUBLIC,
//        "Gridrepublic",
//        "https://www.gridrepublic.org/",
//        tra("Gridrepublic lets you connect your computer to multiple projects, set preferences, and view your credit history."),
//        "logo_gridrepublic_vc.gif"
//    ),
    acct_mgr(
        PROJ_SCIENCE_UNITED,
        "Science United",
        "https://scienceunited.org/",
        tra("Science United is a simple and friendly interface to BOINC.  You sign up for science areas instead of projects."),
        ""
    ),
    acct_mgr(
        PROJ_GRCPOOL,
        "GRCPool",
        "https://grcpool.com",
        tra("GRCPool.com is a cryptocurrency mining pool which rewards work performed using BOINC."),
        ""
    ),
);

?>
