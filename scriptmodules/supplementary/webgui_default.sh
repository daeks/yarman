
#!/usr/bin/env bash

# This file is part of The RetroPie Project
#
# The RetroPie Project is the legal property of its developers, whose names are
# too numerous to list here. Please refer to the COPYRIGHT.md file distributed with this source.
#
# See the LICENSE.md file at the top-level directory of this distribution and
# at https://raw.githubusercontent.com/RetroPie/RetroPie-Setup/master/LICENSE.md
#

rp_module_id="webgui"
rp_module_desc="RetroPie WebGUI"
rp_module_section="exp"

function depends_webgui() {
    getDepends sqlite3 php5 php5-sqlite
}

function install_bin_webgui() {
    gitPullOrClone "$md_inst" "https://github.com/daeks/RetroPie-WebGui"
}

function configure_webgui() {
    php -S "$(hostname -I | xargs):8080" -t "$md_inst" > /dev/null 2>&1 &

    local config="php -S \"\$\(hostname -I \| xargs\):8080\" -t \"$md_inst\" > /dev/null 2>\&1 \&"
    sed -i "s|^exit 0$|${config}\\nexit 0|" /etc/rc.local
}

function remove_webgui() {
    killall php
    aptRemove sqlite3 php5 php5-sqlite
    sed -i "/php/d" /etc/rc.local
    rm -R "$md_inst"
}
1