#!/bin/bash
# Run this script to generate a production ready zip. It will be generated in the parent directory (plugins folder)
# avoiding development-only files, git directories, and the script itself. Works good on OSX =), not tested on linux
PLUGIN_NAME="hustle"
PLUGIN_PATH=$(dirname "$(stat -f "$0")")
TODAY=$(date +"%m-%d-%Y")
ZIP_FILE="$PLUGIN_PATH/../$PLUGIN_NAME-$TODAY.zip"

echo -ne "\nRemoving previous zip file...\n"
rm $ZIP_FILE

echo -ne "\nCreating $ZIP_FILE, please wait...\n"
zip -r $ZIP_FILE $PLUGIN_PATH -x "$PLUGIN_PATH/.git/*" "$PLUGIN_PATH/.*" "$PLUGIN_PATH/composer.*" "$PLUGIN_PATH/Gulpfile.js" "$PLUGIN_PATH/node_modules/*" "$PLUGIN_PATH/package.json" "$PLUGIN_PATH/assets/sass/*" "$PLUGIN_PATH/createzip.sh" > /dev/null

echo -ne "\nDone =)\n"