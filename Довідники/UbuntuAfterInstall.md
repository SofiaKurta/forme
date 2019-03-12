### Install GIT
```sudo apt-get install git```

### Mercurial
```sudo apt-get install mercurial```

### Google Chrome
```wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub | sudo apt-key add - ```\
```sudo sh -c 'echo "deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google.list'```\
```sudo apt-get update```\
```sudo apt-get install google-chrome-stable```\

### Docker
```sudo apt-get update```\
```sudo apt install apt-transport-https ca-certificates curl software-properties-common```\
```curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -```\
```sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu bionic stable"```\
```sudo apt update```\
```apt-cache policy docker-ce```\
```sudo apt install docker-ce```\
```sudo systemctl status docker``` \
Executing the Docker Command Without Sudo \
```sudo usermod -aG docker ${USER}```\
```su - ${USER}```\
```id -nG```\
Install docker-compose\
```sudo apt install docker-compose```

### Ruby
```sudo apt-get install ruby-full```\
Optional(install saas): ```sudo gem install sass```

### NPM
```sudo apt install npm```\
Optional(install less): ```sudo npm install -g less```\
if exist problem with install npm or dependency packages then install packages with aptitude:
+ ```sudo apt install aptitude```
+ ```sudo aptitude install npm```

### Composer 
```sudo apt install composer```

### Install Sublime text (text editor with plugins)
+ ```Package Control```
+ ```Darcula```
+ ```Emmet```
+ ```JavaScript & NodeJS Snippets```
+ ```Advanced New File```
+ ```Git```
+ ```GitGutter```
+ ```Side Bar Enhancements```
+ ```ColorPicker```
+ ```Placeholders```
+ ```DocBlockr```
+ ```SublimeCodeIntel```
+ ```Minify```
+ ```Minify on Save```
+ ```Sublime Linter```
+ ```Color Highlighter```
+ ```Alignment```
+ ```Auto Semi-Colon```
+ ```AutoFileName```
+ ```ApacheConf```
+ ```BracketHighlighter```
+ ```Case Conversion```
+ ```CSS Extended Completions```
+ ```HTML Nest Comments```
+ ```jQuery```
+ ```LESS```
+ ```SASS```
+ ```StyleToken```
+ ```RegReplace```
+ ```Linter```
+ ```SublimeLinter php```

### Install Atom (text editor with plugins)
+ ```autocomplete-plus```
+ ```File-Icons```
+ ```OPEN RECENT```
+ ```TODO-SHOW```
+ ```MINIMAP```
+ ```HIGHLIGHT SELECTED```
+ ```AUTO-CLOSE HTML```
+ ```PIGMENTS```
+ ```LINTER```
+ ```atom-beautify```
+ ```emmet```
+ ```file-icons```
+ ```language-liquid```
+ ```Pane Layout Plus```
+ ```git-blame```
+ ```Git-Plus```
+ ```Auto-Update-Packages```
+ ```autocomplete-paths```
+ ```sync settings```
Themes
+ ```darkula-ui```
+ ```atom-darcula-syntax```
+ ```intellij-darcula-syntax```
+ ```phpstorm-darcula-syntax```
+ ```dracula-syntax```
+ ```nord-atom-syntax```
